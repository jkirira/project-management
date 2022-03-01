<?php

namespace App\Repositories;

use App\Http\Requests\UnitRequest;
use App\Interfaces\UnitInterface;
use App\Unit;

class UnitRepository implements UnitInterface
{

    public function getAllUnits()
    {
        return Unit::latest()->get();
    }

//    public function getTenants(){}
//    public function getManagers(){}

    public function getUnitById($id)
    {
        return Unit::find($id);
    }

    public function getUnitsByName($name)
    {
        return Unit::where('name', $name)->get();
    }

    public function addUnit(UnitRequest $request)
    {
        $validated = $request->validated();

        return Unit::create($validated);

    }

    public function updateUnit(Unit $unit, UnitRequest $request)
    {
        $validated = $request->validated();

        return $unit->update($validated);
    }


    public function deleteUnit(Unit $unit)
    {
        return $unit->delete();
    }
}
