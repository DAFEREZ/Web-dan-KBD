<?php

namespace App\Services;

use Symfony\Component\Process\Process;

class Backup
{
    public static function jalankan(?int $userId = null): void
    {
        $dir = storage_path('app/backups');
        if (! is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        $interval = (int) env('BACKUP_MIN_INTERVAL', 60) * 60;
        $files = glob($dir . '/kbd_*.sql') ?: [];
        if ($interval > 0 && $files) {
            $terakhir = max(array_map('filemtime', $files));
            if (time() - $terakhir < $interval) {
                return;
            }
        }

        $file = $dir . '/kbd_' . date('Ymd_His') . '.sql';
        $cfg  = config('database.connections.mysql');

        $cmd = [
            env('MYSQLDUMP_PATH', 'mysqldump'),
            '--host=' . $cfg['host'],
            '--port=' . $cfg['port'],
            '--user=' . $cfg['username'],
            '--single-transaction',
            '--routines',
            '--triggers',
            '--no-tablespaces',
            '--result-file=' . $file,
            $cfg['database'],
        ];

        // Windows butuh SystemRoot, kalau tidak mysqldump gagal (error 10106)
        $env = [
            'SystemRoot' => getenv('SystemRoot') ?: 'C:\\Windows',
            'windir'     => getenv('windir') ?: 'C:\\Windows',
        ];
        if (($cfg['password'] ?? '') !== '') {
            // lewat env var, bukan argumen, supaya tidak terlihat di daftar proses
            $env['MYSQL_PWD'] = $cfg['password'];
        }

        try {
            $p = new Process($cmd, null, $env);
            $p->setTimeout(120);
            $p->run();

            if (! $p->isSuccessful() || ! is_file($file) || filesize($file) === 0) {
                @unlink($file);
                Audit::catat('BACKUP_GAGAL', null, null, trim($p->getErrorOutput()) ?: 'mysqldump gagal', $userId);
                return;
            }

            Audit::catat('BACKUP', null, null, basename($file) . ' (' . round(filesize($file) / 1024) . ' KB)', $userId);
            self::bersihkan($dir);
        } catch (\Throwable $e) {
            @unlink($file);
            Audit::catat('BACKUP_GAGAL', null, null, $e->getMessage(), $userId);
        }
    }

    private static function bersihkan(string $dir): void
    {
        $files = glob($dir . '/kbd_*.sql') ?: [];
        rsort($files);
        foreach (array_slice($files, (int) env('BACKUP_KEEP', 10)) as $lama) {
            @unlink($lama);
        }
    }
}