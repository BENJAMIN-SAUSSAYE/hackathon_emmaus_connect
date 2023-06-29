<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Brand;
use App\Entity\Model;

class IdentifySearch
{
	private ?Model $model = null;
	private ?Brand $brand = null;

	private ?string $imeiNumber = null;

	/**
	 * Get the value of model
	 */
	public function getModel(): ?Model
	{
		return $this->model;
	}

	/**
	 * Set the value of model
	 *
	 * @return  self
	 */
	public function setModel(?Model $model)
	{
		$this->model = $model;

		return $this;
	}

	/**
	 * Get the value of brand
	 */
	public function getBrand(): ?Brand
	{
		return $this->brand;
	}

	/**
	 * Set the value of brand
	 *
	 * @return  self
	 */
	public function setBrand(?Brand $brand)
	{
		$this->brand = $brand;

		return $this;
	}

	/**
	 * Get the value of imeiNumber
	 */
	public function getImeiNumber(): ?string
	{
		return $this->imeiNumber;
	}

	/**
	 * Set the value of imeiNumber
	 *
	 * @return  self
	 */
	public function setImeiNumber(?string $imeiNumber)
	{
		$this->imeiNumber = $imeiNumber;

		return $this;
	}
}
