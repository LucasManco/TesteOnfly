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
                        <table id="despesas" class="despesas">
                            <thead>
                                <tr>
                                    <th>Descrição</th>
                                    <th>Data</th>
                                    <th>Usuario</th>
                                    <th>Valor</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($despesas as $despesa)
                                    <tr>
                                        <td>{{$despesa->descricao}}</td>
                                        <td>{{$despesa->data}}</td>
                                        <td>{{$despesa->usuario}}</td>
                                        <td>R${{number_format($despesa->valor,2, ',', '.')}}</td>
                                        <td>
                                            <a href="{{route('despesas.edit',$despesa->id)}}">Editar</a>
                                            <!-- <a href="" id="delete" onclick="delete_despesa('{{route('despesas.destroy',$despesa->id)}}')">Excluir</button>                                             -->
                                            <form method="POST" action="{{ route('despesas.destroy',$despesa->id) }}">
                                                @csrf
                                                @method('DELETE')


                                                <button type="submit">
                                                    Excluir
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-10" href="{{route('despesas.create')}}">Nova Despesa</a>
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
