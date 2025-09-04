<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;

class QRController extends Controller
{
    public function show($id)
    {
        // Get all images from the asset folder
        $assetPath = base_path('asset');
        $images = [];
        
        if (File::exists($assetPath)) {
            $files = File::files($assetPath);
            foreach ($files as $file) {
                $extension = strtolower($file->getExtension());
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $images[] = [
                        'filename' => $file->getFilename(),
                        'path' => 'asset/' . $file->getFilename(),
                        'name' => pathinfo($file->getFilename(), PATHINFO_FILENAME)
                    ];
                }
            }
        }
        
        // Sort images by name
        usort($images, function($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
        
        // Get current image index
        $currentIndex = (int) $id - 1;
        $currentImage = null;
        
        if (isset($images[$currentIndex])) {
            $currentImage = $images[$currentIndex];
        }
        
        // Get previous and next image info
        $previousImage = $currentIndex > 0 ? $images[$currentIndex - 1] : null;
        $nextImage = $currentIndex < count($images) - 1 ? $images[$currentIndex + 1] : null;
        
        return Inertia::render('QR/BookViewer', [
            'currentImage' => $currentImage,
            'currentIndex' => $currentIndex + 1,
            'totalImages' => count($images),
            'previousImage' => $previousImage,
            'nextImage' => $nextImage,
            'allImages' => $images
        ]);
    }
}
