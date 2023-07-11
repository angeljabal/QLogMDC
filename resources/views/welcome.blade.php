@extends('layouts.landing.landing')

@section('content')
<!-- component -->
<!-- This is an example component -->
<div>
    <div class="bg-cyan-800 md:overflow-hidden">
      <div class="px-4 py-20 md:py-4">
        <div class="md:max-w-full md:mx-auto">
          <div class="md:ml-10 md:flex md:flex-wrap">
            <div class="md:w-1/2 text-center md:text-left md:pt-16">
                <h1 class="font-extrabold text-white text-7xl md:text-4xl leading-tight mb-4 uppercase animate-pulse">
                  A QR Code Based Priority Queue Viewing System
                </h1>

                <h1 class="font-light text-white text-2xl leading-tight mt-10">
                  How to use:
                </h1>
                <p class="text-indigo-200 text-xl md:pr-48">
                  Step 1: Place your QR Code on the scanner machine. <br>
                  Step 2: Select transaction<br>
                  Step 3: Wait for the printed receipt of your queue number
                </p>

                <h1 class="font-black text-white text-4xl md:text-2xl leading-tight mt-8 uppercase animate-bounce">
                  Scan your qr code to begin...
                </h1>
              <form action='/process-queue' id='myform' class="form-prevent-multiple-submits" method="POST">
                @csrf
                <input type='text' id='link_input' onblur="this.focus();" name="id" autofocus class="bg-cyan-800 focus:outline-none text-yellow-100" autocomplete="off"/>
              </form>
            </div>
            <div class="md:w-1/2 relative">
              <div class="hidden md:block">
                {{-- <div
                  class="-ml-24 -mb-40 absolute left-0 bottom-0 w-40 bg-white rounded-lg shadow-lg px-6 py-8"
                  style="transform: rotate(-8deg);"
                >
                  <div class="bg-gradient-to-r from-teal-700 to-cyan-900 mx-auto rounded-lg px-2 pb-2 relative mb-8">
                    <div class="mb-1">
                      <span
                        class="w-1 h-1 bg-indigo-100 rounded-full inline-block"
                        style="margin-right: 1px;"
                      ></span
                      ><span
                        class="w-1 h-1 bg-indigo-100 rounded-full inline-block"
                        style="margin-right: 1px;"
                      ></span
                      ><span
                        class="w-1 h-1 bg-indigo-100 rounded-full inline-block"
                      ></span>
                    </div>
                    <div class="h-1 w-12 bg-indigo-100 rounded mb-1"></div>
                    <div class="h-1 w-10 bg-indigo-100 rounded mb-2"></div>

                    <div class="flex">
                      <div class="w-6 h-3 rounded bg-indigo-100 mr-1"></div>
                      <div class="w-6 h-3 rounded bg-indigo-100"></div>
                    </div>

                    <div
                      class="-mr-2 -mb-4 absolute bottom-0 right-0 h-16 w-10 rounded-lg bg-gray-900 border-2 border-white"
                    ></div>
                    <div
                      class="w-2 h-2 rounded-full bg-black-800 mx-auto absolute bottom-0 right-0 mr-2 -mb-2 z-10 border-2 border-white"
                    ></div>
                  </div>

                  <div class="text-gray-800 text-center">
                    Scan QR Code
                  </div>
                </div> --}}

                <div
                  class="ml-24 mb-16 absolute left-0 bottom-0 w-40 bg-white rounded-lg shadow-lg px-6 py-8"
                  style="transform: rotate(-8deg); z-index: 2;"
                >
                <img src="{{asset('images/download.png')}}" alt="">

                  <div class="text-gray-800 text-center animate-pulse">
                    Scan <br> QR Code
                  </div>
                </div>

                <div
                  class="ml-32 absolute left-0 bottom-0 w-48 bg-white rounded-lg shadow-lg px-10 py-8"
                  style="transform: rotate(-8deg); z-index: 2; margin-bottom: -220px;"
                >
                  <div class="bg-gradient-to-r from-teal-700 to-cyan-900 mx-auto rounded-lg pt-4 mb-16 relative">
                    <p class="text-center text-white text-xs mb-2">Priority Queue Number</p>
                    <div class="h-4 bg-white">
                    </div>

                    <div class="text-right my-2 pb-1">
                    </div>

                    <div class="-ml-4 -mb-12 absolute left-0 bottom-0 w-16 bg-gradient-to-l from-yellow-700 to-yellow-900 mx-auto rounded-lg pb-2 pt-3">
                      <p class="text-center text-white text-sm mb-2 font-bold">#10</p>
                      <div class="h-2 bg-white mb-2"></div>
                      <p class="text-white p-1" style="font-size: 8px">Cashier's Office</p>
                    </div>
                  </div>

                  <div class="text-gray-800 text-center">
                    Priority Queue Viewing System
                  </div>
                </div>

                <div
                  class="mt-10 w-full absolute right-0 top-0 flex rounded-lg bg-white overflow-hidden shadow-lg"
                  style="transform: rotate(-8deg); margin-right: -250px; z-index: 1;"
                >
                  <div class="w-32 bg-gray-200" style="height: 560px;"></div>
                  <div class="flex-1 p-6">
                    <h2 class="text-lg text-gray-700 font-bold mb-3">
                      Facilities Visited
                    </h2>
                    <div class="flex mb-5">
                      <div class="w-16 rounded-full bg-gray-100 py-2 px-4 mr-2">
                        <div class="p-1 rounded-full bg-gray-300"></div>
                      </div>
                      <div class="w-16 rounded-full bg-gray-100 py-2 px-4 mr-2">
                        <div class="p-1 rounded-full bg-gray-300"></div>
                      </div>
                      <div class="w-16 rounded-full bg-gray-100 py-2 px-4 mr-2">
                        <div class="p-1 rounded-full bg-gray-300"></div>
                      </div>
                      <div class="w-16 rounded-full bg-gray-100 py-2 px-4">
                        <div class="p-1 rounded-full bg-gray-300"></div>
                      </div>
                    </div>

                    <div class="flex flex-wrap -mx-4 mb-5">
                      <div class="w-1/3 px-4">
                        <div class="h-40 rounded-lg bg-white shadow-lg p-6">
                          <div
                            class="w-16 h-16 rounded-full bg-gray-200 mb-6"
                          ></div>
                          <div
                            class="h-2 w-16 bg-gray-200 mb-2 rounded-full"
                          ></div>
                          <div class="h-2 w-10 bg-gray-200 rounded-full"></div>
                        </div>
                      </div>
                      <div class="w-1/3 px-4">
                        <div class="h-40 rounded-lg bg-white shadow-lg p-6">
                          <div
                            class="w-16 h-16 rounded-full bg-gray-200 mb-6"
                          ></div>
                          <div
                            class="h-2 w-16 bg-gray-200 mb-2 rounded-full"
                          ></div>
                          <div class="h-2 w-10 bg-gray-200 rounded-full"></div>
                        </div>
                      </div>
                      <div class="w-1/3 px-4">
                        <div class="h-40 rounded-lg bg-white shadow-lg p-6">
                          <div
                            class="w-16 h-16 rounded-full bg-gray-200 mb-6"
                          ></div>
                          <div
                            class="h-2 w-16 bg-gray-200 mb-2 rounded-full"
                          ></div>
                          <div class="h-2 w-10 bg-gray-200 rounded-full"></div>
                        </div>
                      </div>
                    </div>

                    <h2 class="text-lg text-gray-700 font-bold mb-3">
                      Logs
                    </h2>

                    <div
                      class="w-full flex flex-wrap justify-between items-center border-b-2 border-gray-100 py-3"
                    >
                      <div class="w-1/3">
                        <div class="flex">
                          <div class="h-8 w-8 rounded bg-gray-200 mr-4"></div>
                          <div>
                            <div
                              class="h-2 w-16 bg-gray-200 mb-1 rounded-full"
                            ></div>
                            <div
                              class="h-2 w-10 bg-gray-100 rounded-full"
                            ></div>
                          </div>
                        </div>
                      </div>
                      <div class="w-1/3">
                        <div
                          class="w-16 rounded-full bg-teal-100 py-2 px-4 mx-auto"
                        >
                          <div class="p-1 rounded-full bg-teal-200"></div>
                        </div>
                      </div>
                      <div class="w-1/3">
                        <div
                          class="h-2 w-10 bg-gray-100 rounded-full mx-auto"
                        ></div>
                      </div>
                    </div>

                    <div
                      class="flex flex-wrap justify-between items-center border-b-2 border-gray-100 py-3"
                    >
                      <div class="w-1/3">
                        <div class="flex">
                          <div class="h-8 w-8 rounded bg-gray-200 mr-4"></div>
                          <div>
                            <div
                              class="h-2 w-16 bg-gray-200 mb-1 rounded-full"
                            ></div>
                            <div
                              class="h-2 w-10 bg-gray-100 rounded-full"
                            ></div>
                          </div>
                        </div>
                      </div>
                      <div class="w-1/3">
                        <div
                          class="w-16 rounded-full bg-orange-100 py-2 px-4 mx-auto"
                        >
                          <div class="p-1 rounded-full bg-orange-200"></div>
                        </div>
                      </div>
                      <div class="w-1/3">
                        <div
                          class="h-2 w-16 bg-gray-100 rounded-full mx-auto"
                        ></div>
                      </div>
                    </div>

                    <div
                      class="flex flex-wrap justify-between items-center border-b-2 border-gray-100 py-3"
                    >
                      <div class="w-1/3">
                        <div class="flex">
                          <div class="h-8 w-8 rounded bg-gray-200 mr-4"></div>
                          <div>
                            <div
                              class="h-2 w-16 bg-gray-200 mb-1 rounded-full"
                            ></div>
                            <div
                              class="h-2 w-10 bg-gray-100 rounded-full"
                            ></div>
                          </div>
                        </div>
                      </div>
                      <div class="w-1/3">
                        <div
                          class="w-16 rounded-full bg-blue-100 py-2 px-4 mx-auto"
                        >
                          <div class="p-1 rounded-full bg-blue-200"></div>
                        </div>
                      </div>
                      <div class="w-1/3">
                        <div
                          class="h-2 w-8 bg-gray-100 rounded-full mx-auto"
                        ></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div
                  class="w-full absolute left-0 bottom-0 ml-1"
                  style="transform: rotate(-8deg); z-index: 1; margin-bottom: -360px;"
                >
                  <div class="grid--gray h-48 w-48"></div>
                </div>
              </div>

              <div
                class="md:hidden w-full absolute right-0 top-0 flex rounded-lg bg-white overflow-hidden shadow"
              >
                <div
                  class="h-4 bg-gray-200 absolute top-0 left-0 right-0 rounded-t-lg flex items-center"
                >
                  <span
                    class="h-2 w-2 rounded-full bg-red-500 inline-block mr-1 ml-2"
                  ></span>
                  <span
                    class="h-2 w-2 rounded-full bg-orange-400 inline-block mr-1"
                  ></span>
                  <span
                    class="h-2 w-2 rounded-full bg-teal-500 inline-block mr-1"
                  ></span>
                </div>
                <div class="w-32 bg-gray-100 px-2 py-8" style="height: 340px;">
                  <div class="h-2 w-16 bg-gray-300 rounded-full mb-4"></div>
                  <div class="flex items-center mb-4">
                    <div
                      class="h-5 w-5 rounded-full bg-gray-300 mr-3 flex-shrink-0"
                    ></div>
                    <div>
                      <div class="h-2 w-10 bg-gray-300 rounded-full"></div>
                    </div>
                  </div>

                  <div class="h-2 w-16 bg-gray-200 rounded-full mb-2"></div>
                  <div class="h-2 w-10 bg-gray-200 rounded-full mb-2"></div>
                  <div class="h-2 w-20 bg-gray-200 rounded-full mb-2"></div>
                  <div class="h-2 w-6 bg-gray-200 rounded-full mb-2"></div>
                  <div class="h-2 w-16 bg-gray-200 rounded-full mb-2"></div>
                  <div class="h-2 w-10 bg-gray-200 rounded-full mb-2"></div>
                  <div class="h-2 w-20 bg-gray-200 rounded-full mb-2"></div>
                  <div class="h-2 w-6 bg-gray-200 rounded-full mb-2"></div>
                </div>
                <div class="flex-1 px-4 py-8">
                  <h2 class="text-xs text-gray-700 font-bold mb-1">
                    Facilities Visited
                  </h2>
                  <div class="flex mb-5">
                    <div class="p-2 w-12 rounded-full bg-gray-100 mr-2"></div>
                    <div class="p-2 w-12 rounded-full bg-gray-100 mr-2"></div>
                    <div class="p-2 w-12 rounded-full bg-gray-100 mr-2"></div>
                    <div class="p-2 w-12 rounded-full bg-gray-100 mr-2"></div>
                  </div>

                  <div class="flex flex-wrap -mx-2 mb-5">
                    <div class="w-1/3 px-2">
                      <div class="p-3 rounded-lg bg-white shadow">
                        <div
                          class="w-6 h-6 rounded-full bg-gray-200 mb-2"
                        ></div>
                        <div
                          class="h-2 w-10 bg-gray-200 mb-1 rounded-full"
                        ></div>
                        <div class="h-2 w-6 bg-gray-200 rounded-full"></div>
                      </div>
                    </div>
                    <div class="w-1/3 px-2">
                      <div class="p-3 rounded-lg bg-white shadow">
                        <div
                          class="w-6 h-6 rounded-full bg-gray-200 mb-2"
                        ></div>
                        <div
                          class="h-2 w-10 bg-gray-200 mb-1 rounded-full"
                        ></div>
                        <div class="h-2 w-6 bg-gray-200 rounded-full"></div>
                      </div>
                    </div>
                    <div class="w-1/3 px-2">
                      <div class="p-3 rounded-lg bg-white shadow">
                        <div
                          class="w-6 h-6 rounded-full bg-gray-200 mb-2"
                        ></div>
                        <div
                          class="h-2 w-10 bg-gray-200 mb-1 rounded-full"
                        ></div>
                        <div class="h-2 w-6 bg-gray-200 rounded-full"></div>
                      </div>
                    </div>
                  </div>

                  <h2 class="text-xs text-gray-700 font-bold mb-1">
                    Logs
                  </h2>

                  <div
                    class="w-full flex flex-wrap justify-between items-center border-b-2 border-gray-100 py-3"
                  >
                    <div class="w-1/3">
                      <div class="flex">
                        <div
                          class="h-5 w-5 rounded-full bg-gray-200 mr-3 flex-shrink-0"
                        ></div>
                        <div>
                          <div
                            class="h-2 w-16 bg-gray-200 mb-1 rounded-full"
                          ></div>
                          <div class="h-2 w-10 bg-gray-100 rounded-full"></div>
                        </div>
                      </div>
                    </div>
                    <div class="w-1/3">
                      <div
                        class="w-16 rounded-full bg-teal-100 py-2 px-4 mx-auto"
                      >
                        <div class="p-1 rounded-full bg-teal-200"></div>
                      </div>
                    </div>
                    <div class="w-1/3">
                      <div
                        class="h-2 w-10 bg-gray-100 rounded-full mx-auto"
                      ></div>
                    </div>
                  </div>

                  <div class="flex flex-wrap justify-between items-center py-3">
                    <div class="w-1/3">
                      <div class="flex">
                        <div
                          class="h-5 w-5 rounded-full bg-gray-200 mr-3 flex-shrink-0"
                        ></div>
                        <div>
                          <div
                            class="h-2 w-16 bg-gray-200 mb-1 rounded-full"
                          ></div>
                          <div class="h-2 w-10 bg-gray-100 rounded-full"></div>
                        </div>
                      </div>
                    </div>
                    <div class="w-1/3">
                      <div
                        class="w-16 rounded-full bg-orange-100 py-2 px-4 mx-auto"
                      >
                        <div class="p-1 rounded-full bg-orange-200"></div>
                      </div>
                    </div>
                    <div class="w-1/3">
                      <div
                        class="h-2 w-16 bg-gray-100 rounded-full mx-auto"
                      ></div>
                    </div>
                  </div>
                </div>
              </div>

              <div
                class="mr-3 md:hidden absolute right-0 bottom-0 w-40 bg-white rounded-lg shadow-lg px-10 py-6"
                style="z-index: 2; margin-bottom: -380px;"
              >
                <div
                  class="bg-indigo-800 mx-auto rounded-lg w-20 pt-3 mb-12 relative"
                >
                  <div class="h-3 bg-white"></div>

                  <div class="text-right my-2">
                    {{-- <div
                      class="inline-flex w-3 h-3 rounded-full bg-white -mr-2"
                    ></div>
                    <div
                      class="inline-flex w-3 h-3 rounded-full bg-indigo-800 border-2 border-white mr-2"
                    ></div> --}}
                  </div>

                  <div
                    class="-ml-4 -mb-6 absolute left-0 bottom-0 w-16 bg-teal-700 mx-auto rounded-lg pb-2 pt-3"
                  >
                    <div class="h-2 bg-white mb-2"></div>
                    <div class="h-2 bg-white w-6 ml-auto rounded mr-2"></div>
                  </div>
                </div>

                <div class="text-gray-800 text-center text-sm">
                  Priority <br />Queue
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <svg
        class="fill-current text-white hidden md:block"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 1440 320"
      >
        <path fill-opacity="1" d="M0,224L1440,32L1440,320L0,320Z"></path>
      </svg>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script  language="JavaScript" type="text/JavaScript">
$('#link_input').on('keyup',function(){
  var val = $(this).val();
  var len = val.length;

  if(len > 0){.submit(function() {
    $(this).closest("#link_input").dialog("close");
    return false;
  });
  }
});
</script>

@endsection
