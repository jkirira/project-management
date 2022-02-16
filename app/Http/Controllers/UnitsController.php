<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Interfaces\UnitInterface;
use App\Unit;
use Illuminate\Http\Request;

class UnitsController extends Controller
{

    protected $unitRepo;

    public function __construct(UnitInterface $unitRepo)
    {
        $this->unitRepo = $unitRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = $this->unitRepo->getAllUnits();

        return response()->json($units, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitRequest $unitRequest)
    {
        $unit = $this->unitRepo->addUnit($unitRequest);

        return response()->json($unit, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit = $this->unitRepo->getUnitById($id);

        return response()->json($unit, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Unit $unit, UnitRequest $unitRequest)
    {
        $unit = $this->unitRepo->updateUnit($unit, $unitRequest);

        return response()->json($unit, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $this->unitRepo->deleteUnit($unit);

        return response()->json(['message' => "success"], 200);


    }
}
