<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\User;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingRequest $request): JsonResponse
    {

        $validated = (array) $request->validated();

        $room = Room::find($validated['room_id']);
        $user = User::where('email', $validated['email'])->first();

        if(!$user) {
            $user = User::create([
                'firstname' => $validated['firstname'],
                'lastname' => $validated['lastname'],
                'cin' => $validated['cin'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                // 'password' => $validated['password'],
                'password' => 'password',
            ]);
        }

        $validated['user_id'] = $user->id;


        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $nights = $endDate->diffInDays($startDate);

        $validated['nights'] = $nights;
        $validated['amount'] = $room->price * $nights;

        Booking::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Booking successfully created'
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
