<?php

namespace App\Service;

use App\Interface\UniqTypeGeneratorInterface;
use Error;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class PlaceholderImageService
{
    private string $saveDirectory;
    private UniqTypeGeneratorInterface $generator;
    private string $placeholderServiceProviderUrl;
    private int $minimumImageWidth = 150;
    private int $minimumImageHeight = 150;

    /**
     * @param UniqTypeGeneratorInterface $generator
     * @param ParameterBagInterface $container
     */
    public function __construct(UniqTypeGeneratorInterface $generator, ParameterBagInterface $container){
        $this->generator = $generator;
        $this->saveDirectory = $container->get("upload.directory");
        $this->placeholderServiceProviderUrl = $container->get("placeholderService.url");
    }

    /**
     * Return the downloaded image content as string
     * @param int $width
     * @param int $height
     * @return string
     */
    public function getNewImageStream(int $width, int $height): string{
        if($width < $this->minimumImageWidth || $height < $this->minimumImageHeight){
            throw new Error("The requested image format is too small");
        }
        $content = file_get_contents("{$this->placeholderServiceProviderUrl}/{$width}x{$height}");
        if(!$content){
            throw new Error("Placeholder image cant be downloaded");
        }
        return $content;
    }

    public function getNewImageAndSave(int $width, int $height): string{
        $name = $this->generator->generate() . ".png";
        $file = $this->saveDirectory . $name;
        $bytes = file_put_contents($file, $this->getNewImageStream($width, $height));
        if(file_exists($file) && $bytes){
            return $name;
        }
    }
}