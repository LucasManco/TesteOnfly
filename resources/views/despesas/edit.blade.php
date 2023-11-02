<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                        
                <form class="w-full" method="post" action="{{  isset($despesa) ? route('despesas.update', $despesa->id) : route('despesas.store') }}">
                        @csrf
                        @isset($despesa)
                            @method('PUT')
                        @else
                            @method('POST')
                        @endisset
                        <fieldset>
                        <div class="form-group">
                            <label for="descricao" class="col-md-2 control-label">Descrição</label>

                            <div class="col-md-10">
                                <input type="text" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                value="{{ isset($despesa) ? $despesa->descricao : ''}}" name="descricao" placeholder="Descrição">
                                @error('descricao')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            

                            <div class="flex">
                                <div class="w-1/2">
                                    <label for="data" class="col-md-2 control-label">Data</label>
                                    <input type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    value="{{ isset($despesa) ? $despesa->data : ''}}" name="data">
                                    @error('data')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-1/2">
                                    <label for="valor" class="col-md-2 control-label">Valor</label>
                                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    value="{{ isset($despesa) ? $despesa->valor : ''}}" name="valor" placeholder="0,00">
                                    @error('valor')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <input type="hidden" class="form-control" value="{{ isset($despesa) ? $despesa->usuario : Auth::id()}}" name="usuario">
                                @error('usuario')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            
                             
                            </div>
                        </div>
                        </fieldset>
                        


                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-10">
                            Confirmar
                        </button>
                    </form>
                        
                </div>
            </div>
        </div>
    </div>
    <script>
        function delete_despesa($url){

            var settings = {
            "url": $url,
            "method": "DELETE",
            "timeout": 0,
            "headers": {
                "Authorization": "Bearer " + $('input:hidden[name=_token]')[0].value
            },
            };

            $.ajax(settings).done(function (response) {
            console.log(response);
            });
        }
    </script>
</x-app-layout>
