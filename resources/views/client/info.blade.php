@extends('web')

@section('title')
Info
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            <ul class="list-group">
                <li class="list-group-item active">
                     Captain <span class="badge">{{ $data->name }}</span>
                </li>
                <li class="list-group-item">
                     Reputation <span class="badge">{{ $data->reputation }}</span>
                </li>
                <li class="list-group-item">
                     Alignment <span class="badge">{{ $data->alignment }}</span>
                </li>
                <li class="list-group-item">
                     Affiliation <span class="badge">{{ $data->affiliation }}</span>
                </li>
                <li class="list-group-item">
                    Credits <span class="badge">{{ $data->ship->credits }}</span>
                </li>
            </ul>
        </div>
        <div class="col-sm-4">
            <ul class="list-group">
                <li class="list-group-item active">
                     Ship <span class="badge">{{ $data->ship->name }}</span>
                </li>
                <li class="list-group-item">
                     Class <span class="badge" data-toggle="tooltip" data-placement="right" title="{{ $data->ship->type->description }}">{{ $data->ship->type->name }}</span>
                </li>
                <li class="list-group-item">
                     Structure <span class="badge">{{ $data->ship->structure }}/{{ $data->ship->type->structure }}</span>
                </li>
                <li class="list-group-item">
                     Energy <span class="badge">{{ $data->ship->energy }}/{{ $data->ship->energy_capacity }}</span>
                </li>
                <li class="list-group-item">
                     Unused capacity <span class="badge">{{ $data->ship->type->slots - count($data->ship->items) }}/{{ $data->ship->type->slots }}</span>
                </li>
                <li class="list-group-item">
                     Shields <span class="badge">{{ $data->ship->shields }}</span>
                </li>
                <li class="list-group-item">
                     Armor <span class="badge">{{ $data->ship->armor }}</span>
                </li>
                <li class="list-group-item">
                     Kinetic weapon power <span class="badge">{{ $data->ship->kinetics }}</span>
                </li>
                <li class="list-group-item">
                     Beam weapon power <span class="badge">{{ $data->ship->beams }}</span>
                </li>
            </ul>
        </div>
    </div>
@endsection
