<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <p class="text-right"><a href="">Добавить объявление</a></p>
                @if (count($bbs) > 0)
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Товар</th>
                            <th>Цена, руб.</th>
                            <th colspan="2">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($bbs as $bb)
                            <tr>
                                <td><h3>{{ $bb->title }}</h3></td>
                                <td>{{ $bb->price }}</td>
                                <td>
                                    <a href="">Изменить</a>
                                </td>
                                <td>
                                    <a href="">Удалить</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            </div>
        </div>
    </div>


</x-app-layout>
