<?php

declare(strict_types=1);

namespace App\Services\Shipping;

class PackageDimensions
{
    public function __construct(
        public readonly int $width,
        public readonly int $height,
        public readonly int $length,
    ) {

        match (true) {
            $this->width < 0 || $this->width > 80 => throw new \InvalidArgumentException('Invalid package width '),
            $this->height < 0 || $this->height > 70 => throw new \InvalidArgumentException('Invalid package height '),
            $this->length < 0 || $this->length > 120 => throw new \InvalidArgumentException('Invalid package length '),
            default => true
        };
    }

    // ! This is not possible/correct (because of the 'readonly' keyword, on the property), and this is good. -- This would break the immutability of value objects (because PackageDimensions is one).
    // public function increaseWidth(int $width)
    // {
    //     $this->width += $width;
    // }

    // * This is possible/correct, because we return a new instance of PackageDimensions, with the new, increased width.
    public function increaseWidth(int $width): self
    {
        return new self($this->width + $width, $this->height, $this->length);
    }

    // * This lets us compare two PackageDimensions objects' property valeus, and see if they are equal.
    public function equalTo(PackageDimensions $other)
    {
        return $this->width === $other->width &&
            $this->height === $other->height &&
            $this->length === $other->length;
    }
}
