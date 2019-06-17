<?php

/**
 * Generate multiple captchas
 *
 */

// Set debugging
error_reporting(E_ALL & ~E_NOTICE);

// Defines Securimage class
require_once __DIR__ . '/securimage.php';

// The image
$img = new Securimage();

// Color
$color = new Securimage_Color("#444444");

// Set captcha type to multiple word captcha
$img->captcha_type = Securimage::SI_CAPTCHA_WORDS;

// Adjust font ratio
$img->font_ratio = 0.25;

// Text color
$img->text_color = $color;
$img->peturbation = 0;
$img->noise_level = 0;
$img->use_transparent_text = false;

// Line color
$img->line_color = $color;
$img->num_lines = rand(2, 3);

// Increase image size
$img->image_height = 100;
$img->image_width  = 95 * M_E;

// Don't stop afterwards
$img->no_exit = true;

// Arguments
$amount = $argv[1] ?: 1;
$img->location = (@$argv[2] ?: __DIR__ . "/captchas") . "/";

if (!is_dir($img->location)) {
    exit("Directory $argv[2] doesn't exist.");
}

echo "Generating $amount captchas...\n";

for($i = 0; $i < $amount; $i++) {

    $img->createCode();
    $img->show();
    echo "  Generating #" . ($i+1) . ": " . $img->code_display . "\n";

}
