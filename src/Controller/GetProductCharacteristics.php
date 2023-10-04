<?php

namespace App\Controller;
use App\Entity\ProductCharacteristic;
use App\Repository\CharacteristicVariantRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Doctrine\Common\Collections\Collection;

#[AsController]
class GetProductCharacteristics extends AbstractController
{
    public function __construct(
        private ProductRepository $productRepository,
        private CharacteristicVariantRepository $characteristicVariantRepository
    )
    {
    }

    public function __invoke($id)
    {
        $product = $this->productRepository->find($id);
        $newProductCharacteristics = [];
        foreach ($product->getProductCharacteristics() as $productCharacteristic) {
            if ($productCharacteristic->getCharacteristic()->getType() !== 'enum') {
                $productCharacteristic->setValue(
                    (float)$productCharacteristic->getValue()
                );
                $newProductCharacteristics[] = $productCharacteristic;
                continue;
            }

            $productCharacteristic->setValue(
                $this->characteristicVariantRepository->find(
                    $productCharacteristic->getValue()
                )
            );

            $newProductCharacteristics[] = $productCharacteristic;
        }

        return $newProductCharacteristics;
    }
}