<?php namespace App\Traits;

use App\Models\Address;

trait AddressableTrait  {
    public function getAddressStreetAttribute() {
        if ($this->address) {
            return $this->address->street;
        }
        return null;
    }

    public function getAddressZipAttribute() {
        if ($this->address) {
            return $this->address->zipcode;
        }
        return null;
    }

    public function getAddressCityAttribute() {
        if ($this->address) {
            return $this->address->city;
        }
        return null;
    }

    public function getAddressInstructionsAttribute() {
        if ($this->address) {
            return $this->address->instructions;
        }
        return null;
    }
}