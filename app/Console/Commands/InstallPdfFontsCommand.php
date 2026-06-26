<?php

namespace App\Console\Commands;

use FontLib\Font;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallPdfFontsCommand extends Command
{
    protected $signature = 'pdf:install-fonts';

    protected $description = 'ติดตั้งฟอนต์ TH Sarabun New สำหรับ dompdf';

    /** @var array<string, string> */
    private array $variants = [
        'normal' => 'thsarabunnew.ttf',
        'bold' => 'thsarabunnew_bold.ttf',
        'italic' => 'thsarabunnew_italic.ttf',
        'bold_italic' => 'thsarabunnew_bold_italic.ttf',
    ];

    public function handle(): int
    {
        $sourceDir = resource_path('fonts');
        $targetDir = storage_path('fonts');

        if (! File::isDirectory($sourceDir)) {
            $this->error('ไม่พบโฟลเดอร์ resources/fonts');

            return self::FAILURE;
        }

        File::ensureDirectoryExists($targetDir);

        $familyEntry = [];

        foreach ($this->variants as $style => $filename) {
            $source = $sourceDir.'/'.$filename;

            if (! File::exists($source)) {
                $this->error("ไม่พบไฟล์ฟอนต์: {$filename}");

                return self::FAILURE;
            }

            $basename = pathinfo($filename, PATHINFO_FILENAME);
            $targetTtf = $targetDir.'/'.$basename.'.ttf';
            $targetUfm = $targetDir.'/'.$basename.'.ufm';

            File::copy($source, $targetTtf);
            $this->generateMetrics($source, $targetUfm);

            $familyEntry[$style] = $basename;
            $this->line("✓ {$basename}");
        }

        $installedFonts = [];

        if (File::exists($targetDir.'/installed-fonts.json')) {
            $installedFonts = json_decode(File::get($targetDir.'/installed-fonts.json'), true) ?? [];
        }

        $installedFonts['thsarabunnew'] = $familyEntry;

        File::put(
            $targetDir.'/installed-fonts.json',
            json_encode($installedFonts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );

        $this->info('ติดตั้งฟอนต์ TH Sarabun New สำหรับ PDF เรียบร้อยแล้ว');

        return self::SUCCESS;
    }

    private function generateMetrics(string $ttfPath, string $ufmPath): void
    {
        $font = Font::load($ttfPath);
        $font->parse();
        $font->saveAdobeFontMetrics($ufmPath);
        $font->close();
    }
}
