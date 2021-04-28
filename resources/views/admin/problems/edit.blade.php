@extends('admin.controlpanel')

@section('admin')
<div class="container mx-auto px-6 py-8">
  @if ($message = Session::get('error'))
<div class="flex justify-center items-center m-1 font-medium py-1 px-2 rounded-md text-red-700 bg-red-100 border border-red-300 ">
  <div slot="avatar">
      <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-5 h-5 mx-2">
          <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
          <line x1="12" y1="8" x2="12" y2="12"></line>
          <line x1="12" y1="16" x2="12.01" y2="16"></line>
      </svg>
  </div>
  <div class="text-xl font-normal  max-w-full flex-initial">
    {{ $message }}</div>
</div>
@endif
  <h3 class="text-gray-700 text-3xl font-medium"><a href="{{ route('problems-view') }}">Problems Library/</a>edit</h3>
  <section class="py-40 bg-opacity-50 h-screen">
    <form  method="POST" action="{{ route('problems-edit', ['id' => $problem[0]->id ]) }}" enctype="multipart/form-data">
      @csrf
    <div class="mx-auto container max-w-2xl md:w-3/4 shadow-md">
      <div class="bg-white space-y-6">
        <div class="md:inline-flex space-y-4 md:space-y-0 w-full p-4 text-gray-500 items-center">
          <h2 class="md:w-1/3 max-w-sm mx-auto">Description</h2>
          <div class="md:w-2/3 mx-auto max-w-sm space-y-5">
            <div>
              <label class="text-sm text-gray-400">Problem Name</label>
              <div class="w-full inline-flex border">
                <div class="w-1/12 pt-2 bg-gray-100">
                </div>
                <input
                  id="name"
                  name="name"
                  type="text"
                  value="{{$problem[0]->name}}"
                  class="w-11/12 focus:outline-none focus:text-gray-600 p-2"
                />
              </div>
              @error('name')
                  <div class="text-red-500">{{ $message }}</div>
              @enderror
            </div>
            <div>
              <label class="text-sm text-gray-400">Problem Description</label>
              <div class="w-full inline-flex border">
                <div class="pt-2 w-1/12 bg-gray-100">
                </div>
                <textarea
                  id="description"
                  name="description"
                  class="w-11/12 focus:outline-none focus:text-gray-600 p-2"
                  rows="4" cols="50"
                > {{$problem[0]->description}}</textarea>
              </div>
              @error('description')
                  <div class="text-red-500">{{ $message }}</div>
              @enderror
            </div>
            <div>
              <label class="text-sm text-gray-400">Question (pdf file)</label>
              <label class="text-sm text-gray-400"><a  href="{{url('/contests/library/'. $problem[0]->file) }}">current file</a></label>

              <div class="w-full inline-flex">
                <div class="pt-2 w-1/12 bg-gray-100">
                </div>
                <input
                  id="question"
                  name="question"
                  type="file"
                  class="w-11/12 focus:outline-none focus:text-gray-600 p-2" 
                />
              </div>
              @error('question')
              <div class="text-red-500">{{ $message }}</div>
          @enderror
            </div>
          </div>
        </div>

        <hr />
        <div class="md:inline-flex w-full space-y-4 md:space-y-0 p-8 text-gray-500 items-center">
          <h2 class="md:w-4/12 max-w-sm mx-auto">Settings</h2>
          <div class="md:w-2/3 mx-auto max-w-sm space-y-5">
            <div>
              <label class="text-sm text-gray-400">score point</label>
              <div class="w-full inline-flex border">
                <div class="w-1/12 pt-2 bg-gray-100">
                </div>
                <input
                  id="score"
                  name="score"
                  value="{{$problem[0]->points}}"
                  type="text"
                  class="w-11/12 focus:outline-none focus:text-gray-600 p-2"
                />
              </div>
              @error('score')
                  <div class="text-red-500">{{ $message }}</div>
              @enderror
            </div>

          </div>
  
        </div>
  
        <hr />
        <div class="w-full p-4 text-right text-gray-500">
          <button type="submit" class="inline-flex items-center focus:outline-none mr-4">
            SUBMET
          </button>
        </div>
      </div>
    </div>
  </form>
  </section>
</div>
@endsection