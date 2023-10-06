function convertToWebP($imagePath, $outputPath)
{
    // Load the original image
    $image = imagecreatefromstring(file_get_contents($imagePath));

    // Create a blank image with the same dimensions
    $webpImage = imagecreatetruecolor(imagesx($image), imagesy($image));

    // Enable alpha blending for transparent images
    imagealphablending($webpImage, false);
    imagesavealpha($webpImage, true);

    // Fill the blank image with a transparent background
    $transparentColor = imagecolorallocatealpha($webpImage, 0, 0, 0, 127);
    imagefill($webpImage, 0, 0, $transparentColor);

    // Copy the original image onto the blank image
    imagecopy($webpImage, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));

    // Save the image as WebP format
    imagewebp($webpImage, $outputPath);

    // Free up memory
    imagedestroy($image);
    imagedestroy($webpImage);

    echo "Image converted and saved as $outputPath";
}
