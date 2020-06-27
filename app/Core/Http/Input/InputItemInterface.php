<?php

namespace Solital\Core\Http\Input;

interface InputItemInterface
{

    public function getIndex(): string;

    public function setIndex(string $index): self;

    public function getName(): ?string;

    public function setName(string $name): self;

    public function getValue(): ?string;

    public function setValue(string $value): self;

    public function __toString(): string;

}