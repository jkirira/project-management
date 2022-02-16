<?php

namespace App\Interfaces;

use App\Http\Requests\UnitRequest;
use App\Unit;

interface UnitInterface
{

    public function getAllUnits();

    public function getUnitById($id);

    public function getUnitsByName($name);

    public function addUnit(UnitRequest $request);

    public function updateUnit(Unit $unit, UnitRequest $request);

    public function deleteUnit(Unit $unit);
}
