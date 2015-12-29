@extends('web')

@section('title')
Info
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            <ul class="list-group">
                <li class="list-group-item active">
                     Captain <span class="badge">{{ $data->user->name }}</span>
                </li>
                <li class="list-group-item">
                     Reputation <span class="badge">{{ $data->user->reputation }}</span>
                </li>
                <li class="list-group-item">
                     Alignment <span class="badge">{{ $data->user->alignment }}</span>
                </li>
                <li class="list-group-item">
                     Affiliation <span class="badge">{{ $data->user->affiliation }}</span>
                </li>
                <li class="list-group-item">
                    Credits <span class="badge">{{ $data->user->ship->credits }}</span>
                </li>
            </ul>
        </div>
        <div class="col-sm-4">
            <ul class="list-group">
                <li class="list-group-item active">
                     Ship <span class="badge">{{ $data->user->ship->name }}</span>
                </li>
                <li class="list-group-item">
                     Class <span class="badge" data-toggle="tooltip" data-placement="right" title="{{ $data->user->ship->type->description }}">{{ $data->user->ship->type->name }}</span>
                </li>
                <li class="list-group-item">
                     Structure <span class="badge">{{ $data->user->ship->structure }}/{{ $data->user->ship->type->structure }}</span>
                </li>
                <li class="list-group-item">
                     Energy <span class="badge">{{ $data->user->ship->energy }}/{{ $data->user->ship->energy_capacity }}</span>
                </li>
                <li class="list-group-item">
                     Unused capacity <span class="badge">{{ $data->user->ship->type->slots - count($data->user->ship->items) }}/{{ $data->user->ship->type->slots }}</span>
                </li>
                <li class="list-group-item">
                     Shields <span class="badge">{{ $data->user->ship->shields }}</span>
                </li>
                <li class="list-group-item">
                     Armor <span class="badge">{{ $data->user->ship->armor }}</span>
                </li>
                <li class="list-group-item">
                     Kinetic weapon power <span class="badge">{{ $data->user->ship->kinetics }}</span>
                </li>
                <li class="list-group-item">
                     Beam weapon power <span class="badge">{{ $data->user->ship->beams }}</span>
                </li>
            </ul>
        </div>
    </div>
@endsection
