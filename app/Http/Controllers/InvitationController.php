<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invitations = Invitation::all();
        if (request()->is('api/*')) {
            return response([
                'invitations' => $invitations,
            ]);

        } else {

            return view('invitations.index', compact('invitations'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invitations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'surname' => 'required|string',
            'display_name' => 'required|string',
            'type' => [
                'required',
                Rule::in(['family', 'single']),
            ],
            'plus_one' => [
                'required',
                Rule::in(['yes', 'no']),
            ],
            'guests' => 'required|numeric',
            'notes' => 'nullable|string|max:2000',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            dd($validator->messages()->first());
        }

        $pin = mt_rand(1000, 9999);

        $invitation = new Invitation();
        $invitation->surname = $request->surname;
        $invitation->display_name = $request->display_name;
        $invitation->type = $request->type;
        $invitation->plus_one = $request->plus_one;
        $invitation->guests = $request->guests;
        $invitation->notes = $request->notes;
        $invitation->pin = $pin;

        $invitation->save();

        return redirect()->route('invitations.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Invitation $invitation)
    {
        try {
            $rules = [
                'pin' => 'nullable|numeric',
                'surname' => 'required|string',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                dd($validator->messages()->first());
            }

            $pin = $request->is('api/*') ? $request->pin : intval($invitation->pin);

            $surname = $request->is('api/*') ? $request->surname : $invitation->surname;

            $invitation = Invitation::where(['surname' => $surname, 'pin' => $pin])->firstOrFail();

            if ($request->is('api/*')) {

                return response([
                    'invitation' => $invitation,
                ]);

            } else {
                return redirect()->route('invitations.index');
            }

        } catch (\Exception $e) {
            return response([
                'success' => false,
                'meessage' => $e->getMessage(),
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invitation = Invitation::findOrFail($id);

        return view('invitations.edit', compact('invitation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {

        if (!$request->is('api/*')) {

            $validatedData = $request->validate([
                'surname' => 'nullable|string',
                'display_name' => 'nullable|string',
                'confirmation' => ['nullable', Rule::in(['yes', 'no'])],
                'guests' => 'nullable|numeric',
                'plus_one' => ['nullable', Rule::in(['yes', 'no'])],
                'notes' => 'nullable|string|max:100',
            ]);

            Invitation::where('id', $id)->update($validatedData);
            return redirect()->route('invitations.index');
        } else {
            try {
                $allowedFields = [
                    'confirmation',
                    'plus_one',
                    'guests',
                    'surname',
                    'display_name',
                ];

                // Checking if the $request doesn't contain any of the allowed fields
                if (!$request->hasAny($allowedFields)) {
                    throw new \Exception('Field not allowed');
                }

                $rules = [
                    'invitation' => 'required|numeric|exists:invitations,id',
                    'confirmation' => ['nullable', Rule::in(['yes', 'no'])],
                    'guests' => 'nullable|numeric',
                    'plus_one' => ['nullable', Rule::in(['yes', 'no'])],
                ];

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    dd($validator->messages()->first());
                }

                $invitation = Invitation::findOrFail($request->invitation);

                $this->updateModel($invitation, $request->all(), 'invitation');

                // if (!updatedInvitation) {
                //     throw new \Exception('Something went while updating invitation');
                // }

                return response([
                    'success' => true,
                    'invitation' => $invitation->latest('updated_at')->first(),
                ]);

            } catch (\Exception $e) {
                return response([
                    'success' => false,
                    'meessage' => $e->getMessage(),
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invitation = Invitation::findOrFail($id);
        $invitation->delete();

        return redirect('/invitations')->with('success', 'Invitation Data is successfully deleted');
    }

    public function updateInvitation(Request $request)
    {
        //
    }

    private function updateModel($model, $fields, $excludeField)
    {

        try {
            foreach ($fields as $field => $value) {
                if ($field !== $excludeField) {
                    $model->$field = $value;
                }
            }
            $model->save();
            return true;

        } catch (\Exception $e) {

            return response([
                'success' => false,
                'meessage' => $e->getMessage(),
            ]);
        }
    }

}