
<div>
    <h3>Conceptos pendientes</h3>
    <div class="conceptos-pendientes-content">


            <div class="card card-conceptos-pendientes" >
{{--                <h4 class="text-nombre" style="background-color: {{$user->color}}">{{$user->nombre}}</h4>--}}
                {{--        <div class="card-header">{{$user->nombre}}</div>--}}
                <div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Quien</th>
                            <th>Total</th>
                            <th>Debe</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->nombre}}</td>
                            <td>{{$user->totalConceptoAcumulado}}€</td>
                            <td class="{{($user->resultadoDeber) > 0 ? 'text-success' : 'text-danger'}}">{{$user->resultadoDeber}}€</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

    </div>
</div>


