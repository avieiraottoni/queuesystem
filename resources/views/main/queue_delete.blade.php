<x-layouts.auth-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <div class="main-card overflow-auto">
        <p class="title-2">Eliminar fila de espera</p>
        
        <hr class="my-4">



        <p class="text-lg text-zinc-600 font-bold">Nome: {{ $queue->name }}</p>
        <p class="text-lg text-zinc-600 font-bold mb-4">Hash code: {{ $queue->hash_code }}</p>
        
        <p class="texte-slate-600 mb-4">
            Tem certeza que deseja eliminar a fila de espera? 
        </p>

        <div class="flex gap-4">
            <a href="{{ route('home') }}" class="btn !px-8">Não</a>
            <a href="{{ route('queue.delete.confirm', ['id' => Crypt::encrypt($queue->id)]) }}" class="btn-red !px-8">Sim</a>
        </div>
        <p class="mb-4"></p>
        <p class="text-sm text-zinc-600 text-slate mb-2"> <b>ATENÇÃO:</b></p>
        <p class="text-sm text-zinc-600 text-slate mb-2">Esta operação é reversível.</p>

    </div>

</x-layouts.auth-layout>