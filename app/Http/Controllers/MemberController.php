<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();
        return response()->json([ "data" => $members ]);
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
     * @param  \App\Http\Requests\StoreMemberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberRequest $request)
    {
        $member = new Member($request->only('name', 'birth_date', 'gender'));
        $member->save();
        return response()->json($member, 201);
    }

    public function rent(Request $request, Member $member) {
        $find = Member::find($member->id);
        if (is_null($find)) {
            return response()->json([ 'message' => 'Nincs ilyen tag'], 404);
        }

        $count = Payment::where('member_id', $member->id)
            ->where('paid_at', '>=', Carbon::now()->subDays(30))
            ->count();
        if ($count > 0) {
            return response()->json([ 'message' => 'Már fizetett'], 409);
        }

        $payment = new Payment();
        $payment->member_id = $member->id;
        $payment->amount =  5000;
        $payment->paid_at = Carbon::now();
        $payment->save();
        return response()->json($payment, 201); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMemberRequest  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }
}
