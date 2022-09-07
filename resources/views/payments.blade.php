@extends('layouts.user_type.auth')

@section('content')
@if(Auth::user()->id == 1)
                  <form action="{{url('payments')}}" method="POST" role="form text-left">
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
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="user-name" class="form-control-label">Enter number being paid for</label>
                                  <div class="@error('number_id')border border-danger rounded-3 @enderror">
                                  <input class="form-control" type="tel" placeholder="40770888444" id="number" name="number">
                                          @error('number_id')
                                              <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                          @enderror
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="payment_method" class="form-control-label">Payment Method</label>
                                  <div class="@error('payment_method')border border-danger rounded-3 @enderror">
                                    <select class="form-control" name="payment_method">
                                        <option value="payment_method" disabled selected>Select Payment Method</option>
                                        <option value = "Bank">Bank </option>
                                        <option value = "Transfer">Mobile Transfer</option>
                                        <option value = "Card">Card </option>
                                        <option value = "BTC">BTC </option>           
                                    </select>
                                          @error('payment_method')
                                              <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                          @enderror
                                  </div>
                              </div>
                            </div>
                        </div>
                      <div class="form-group">
                          <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Upload Payment' }}</button>
                      </div>
                  </form>
                @endif
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>All Payments</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">S/N</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Buyer</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Amount</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Paid at</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($payments as $payment)
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h5 class="mb-0 text-sm">{{$loop->iteration }}</h5>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h5 class="mb-0 text-sm">{{$payment->user->name}}</h5>
                            </div>
                          </div>
                        </td>
                        <td>
                        <h5 class="mb-0 text-sm">${{$payment->amount}}</h5>
                        </td>
                        <td class="align-middle text-center text-sm">
                          @if($payment->status == 'Initiated')
                          <span class="badge badge-sm bg-gradient-info">{{$payment->status}}</span>
                          @else 
                          <span class="badge badge-sm bg-gradient-success">{{$payment->status}}</span>
                          @endif
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">{{$payment->created_at->diffForHumans()}}</span>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex">
                            <div class="d-flex flex-column justify-content-center">
                              @if($payment->status == 'Approved')

                              @else
                                  {!! Form::open(['route' => ['payments.update', $payment->id], 'method' => 'patch']) !!}
                                    {!! Form::button('Approve', [
                                        'type' => 'submit',
                                        'class' => 'btn bg-gradient-dark btn-sm mt-4 sm-4',
                                        'onclick' => "return confirm('Are you sure you want to approve this payment?')"
                                        ]) !!}
                                  {!! Form::close() !!}
                              @endif
                            </div>
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
