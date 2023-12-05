<?php

namespace App\Service;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ContactToJson
{
    private $serializer;
    private $kernel;

    public function __construct(SerializerInterface $serializer, KernelInterface $kernel)
    {
        $this->serializer = $serializer;
        $this->kernel = $kernel;
    }


    /**
     * Transforms the object received from the controller into json and saves it in the json_files folder, 
     * kernelInterface injection was necessary to retrieve the full path of the folder
     *
     * @param Form $data
     * @return void
     */
    public function add($data)
    {
        $fileName = uniqid("{$data->getName()}-{$data->getId()}");
        $dataToJson = $this->serializer->serialize($data, 'json');

        $pathToJsonFolder = $this->kernel->getProjectDir().'/json_files/';
        $pathToJsonFile = $pathToJsonFolder . $fileName .'.json';

        if(!file_exists($pathToJsonFolder)){
            mkdir($pathToJsonFolder, 0755);
        }

        file_put_contents($pathToJsonFile, $dataToJson);
    }
}