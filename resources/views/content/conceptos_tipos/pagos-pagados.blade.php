
<div>
    <h3>Conceptos pagados</h3>
    <div class="conceptos-pagados-content">

        @foreach($users as $user)
            <div class="card card-conceptos-pagados" >
                <h4 class="text-nombre" style="background-color: {{$user->color}}">{{$user->nombre}}</h4>
                {{--        <div class="card-header">{{$user->nombre}}</div>--}}
                <div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>EUR</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->conceptos as $concepto)
                            <tr>
                                <td>{{$concepto->concepto}}</td>
                                <td>{{$concepto->euro}}€</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</div>


