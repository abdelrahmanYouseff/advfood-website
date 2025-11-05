<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;

class QRController extends Controller
{
    public function show($id)
    {
        // Special handling for Delawa menu (route /qrs/1)
        if ($id == 1) {
            return $this->showDelawaMenu($id);
        }

        // Special handling for PDF book viewer (route /qrs/2)
        if ($id == 2) {
            return $this->showPdfBook();
        }

        // Get all images from the asset folder
        $assetPath = public_path('asset');
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

    private function showDelawaMenu($id)
    {
        // Get all images from the menu/delawa/new folder
        $menuPath = public_path('menu/delawa/new');
        $images = [];

        if (File::exists($menuPath)) {
            $files = File::files($menuPath);
            foreach ($files as $file) {
                $extension = strtolower($file->getExtension());
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $images[] = [
                        'filename' => $file->getFilename(),
                        'path' => 'menu/delawa/new/' . $file->getFilename(),
                        'name' => pathinfo($file->getFilename(), PATHINFO_FILENAME)
                    ];
                }
            }
        }

        // Sort images by name to ensure correct order (1, 2, 3, 4, 5, 6, ...)
        usort($images, function($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        // Get current image index (id = 1 means first image)
        $currentIndex = (int) $id - 1;
        $currentImage = null;

        if (isset($images[$currentIndex])) {
            $currentImage = $images[$currentIndex];
        } elseif (count($images) > 0) {
            // If specific index not found, show first image
            $currentImage = $images[0];
            $currentIndex = 0;
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

    private function showPdfBook()
    {
        // Get all images from the bakiza-pdf folder
        $assetPath = public_path('asset/bakiza-pdf');
        $images = [];

        if (File::exists($assetPath)) {
            $files = File::files($assetPath);
            foreach ($files as $file) {
                $extension = strtolower($file->getExtension());
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $images[] = [
                        'filename' => $file->getFilename(),
                        'path' => 'asset/bakiza-pdf/' . $file->getFilename(),
                        'name' => pathinfo($file->getFilename(), PATHINFO_FILENAME)
                    ];
                }
            }
        }

        // Sort images by name to ensure correct order
        usort($images, function($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        // Get first image as current
        $currentImage = $images[0] ?? null;
        $currentIndex = 1;
        $totalImages = count($images);

        // Get previous and next image info
        $previousImage = null; // First page, no previous
        $nextImage = $totalImages > 1 ? $images[1] : null;

        return Inertia::render('QR/BakizaBookViewer', [
            'currentImage' => $currentImage,
            'currentIndex' => $currentIndex,
            'totalImages' => $totalImages,
            'previousImage' => $previousImage,
            'nextImage' => $nextImage,
            'allImages' => $images
        ]);
    }
}
