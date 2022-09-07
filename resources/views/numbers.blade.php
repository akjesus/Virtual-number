@extends('layouts.user_type.auth')

@section('content')

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
         
          @if(Auth::user()->role_id == 1)
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h6>Numbers Table</h6>          
              </div>
          @endif
              <div class="card-body px-0 pt-0 pb-2">
              <div class="card-body pt-4 p-3">
                @if(Auth::user()->id == 1)
                  <form action="{{url('numbers')}}" method="POST" role="form text-left">
                      @csrf
                      @if($errors->any())
                          <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                              <span class="alert-text text-white">
                              {{$errors->first()}}</span>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                  <i class="fa fa-close" aria-hidden="true"></i>
                              </button>
                          </div>
                      @endif
                      @isset($message)
                          <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                              <span class="alert-text text-white">
                              {{$message}}</span>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                  <i class="fa fa-close" aria-hidden="true"></i>
                              </button>
                          </div>
                      @endisset
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="user-name" class="form-control-label">Select a Country</label>
                                  <div class="@error('country_id')border border-danger rounded-3 @enderror">
                                  <select class="form-control" name="country_id">
                                      <option value="option_select" disabled selected>Select a Country</option>
                                      @foreach($countries as $country)
                                          <option value="{{ $country->id }}" {{$country->name == $country->id  ? 'selected' : ''}}> {{ $country->nicename}}</option>
                                      @endforeach
                                </select>
                                          @error('country_id')
                                              <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                          @enderror
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="operator_id" class="form-control-label">Select an Operator</label>
                                  <div class="@error('operator_id')border border-danger rounded-3 @enderror">
                                  <select class="form-control" name="operator_id">
                                      <option value="option_select" disabled selected>Select an Operator</option>
                                      @foreach($operators as $operator)
                                          <option value="{{ $operator->id }}" {{$operator->name == $operator->id  ? 'selected' : ''}}> {{ $operator->name}}</option>
                                      @endforeach
                                </select>
                                          @error('operator_id')
                                              <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                          @enderror
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="number" class="form-control-label">Enter a Number</label>
                                  <div class="@error('number')border border-danger rounded-3 @enderror">
                                      <input class="form-control" type="tel" placeholder="40770888444" id="number" name="number">
                                          @error('number')
                                              <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                          @enderror
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="amount" class="form-control-label"> Set a Price</label>
                                  <div class="@error('amount') border border-danger rounded-3 @enderror">
                                      <input class="form-control" type="text" placeholder="$1234" id="amount" name="amount">
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="payment_method" class="form-control-label"> Payment Method</label>
                                  <div class="@error('payment_method') border border-danger rounded-3 @enderror">
                                  <select class="form-control" name="payment_method">
                                      <option value="payment_method" disabled selected>Select Payment Method</option>
                                      <option value = "Bank">Bank </option>
                                      <option value = "Transfer">Transfer</option>
                                      <option value = "Card">Card </option>
                                      <option value = "BTC">BTC </option>           
                                  </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="user" class="form-control-label"> Choose a User</label>
                                  <div class="@error('user') border border-danger rounded-3 @enderror">
                                      <select class="form-control" name="user_id">
                                        <option value="user_select" disabled selected>Choose a User</option>
                                        @foreach($users as $users)
                                          <option value="{{ $users->id }}" {{$users->name == $users->id  ? 'selected' : ''}}> {{ $users->name}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="options" class="form-control-label"> Enter any options</label>
                                  <div class="@error('options') border border-danger rounded-3 @enderror">
                                  <input class="form-control" type="text" placeholder="Any Options" id="options" name="options">
                                  </div>
                              </div>
                          </div>
                      </div>                  
                      <div class="form-group">
                          <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Create Number' }}</button>
                      </div>
                  </form>
                @endif
            </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
            @if(Auth::user()->role_id ==1)<h6>All Numbers</h6>
            @else <h6>My Numbers</h6>
            @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">S/N</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Number</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Country</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Operator</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Payment Method</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Owner</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Action</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($numbers as $number)
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">{{$loop->iteration}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="{{asset('assets/img/small-logos/logo-spotify.svg')}}" class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">{{$number->number}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{$number->country->nicename}}</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">{{$number->operator->name}}</span>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">${{$number->amount}}</span>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">{{$number->payment_method}}</span>
                      </td>
                      <td class="align-middle text-center">
                      <span class="text-xs font-weight-bold">{{$number->user->name}}</span>
                        <!-- <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">100%</span>
                          <div>
                          <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                          </div>
                        </div> -->
                      </td>
                      <td class="align-middle">
                      {!! Form::open(['route' => ['numbers.destroy', $number->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            {!! Form::button('<i class="fa fa-trash"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'onclick' => "return confirm('Are you sure?')"
                            ]) !!}
                        </div>
                      {!! Form::close() !!}
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  
  @endsection
