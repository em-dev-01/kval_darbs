@extends('layouts.app')
@section('content')
    <main class="col-md-9 mx-auto col-lg-10 px-md-4">
        @include('components.success-alert')
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Darbinieki</h1>
        </div>
        <div class="container">
            <div class="row">
                <table>
                    <tr>
                        <th>Vārds</th>
                        <th>Uzvārds</th>
                        <th>E-pasts</th>
                        <th>Telefona numurs</th>
                        <th>Loma</th>
                        <th>Statuss</th>
                    </tr>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->role->role_name }}</td>

                            @if ($user->accepted_status == false)
                                <td>Nav apstiprināts</td>
                                <td><form method="POST" action="{{ route('users.accept', $user) }}">
                                  @csrf
                                  @method('POST')
                                  <button type="submit" class="btn btn-success btn-md">Apstiprināt</button>
                                </form></td>
                                <td><form method="POST" action="{{ route('users.deny', $user) }}">
                                  @csrf
                                  @method('POST')
                                  <button type="submit" class="btn btn-danger btn-md">Noraidīt</button>
                              </form>
                              </td>
                            @else
                                <td>Apstiprināts</td>
                                <td></td>
                                <td></td>
                            @endif
                            
                            <td>
                              @if (Auth::user()->id != $user->id)
                                <form method="POST" action="{{ route('users.destroy', $user) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-md"
                                        onclick="return confirm('Vai tiešām vēlaties dzēst lietotāju?')">Dzēst lietotāju</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </main>
@endsection
