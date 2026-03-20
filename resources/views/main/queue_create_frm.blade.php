<x-layouts.auth-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">
    <div class="main-card overflow-auto">

        <div class="flex justify-between items-center">
            <p class="title-2">Criar nova fila de espera</p>
            <a href="#" class="btn"><i class="fa-solid fa-arrow-left me-2"></i>Voltar</a>
        </div>

        <hr class="my-4">

        <div class="flex gap-4">

            <div class="w-1/2">

                <form action="#" method="POST" novalidate>

                    <div class="mb-4">
                        <label for="name" class="label">Nome da fila</label>
                        <input type="text" name="name" id="name" class="input w-full" placeholder="Nome da fila">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="label">Descrição</label>
                        <input type="text" name="description" id="description" class="input w-full"
                            placeholder="Descrição da fila">
                    </div>

                    <div class="flex gap-4 mb-4">
                        <div class="w-1/2">
                            <label for="service" class="label">Serviço</label>
                            <input type="text" name="service" id="service" class="input w-full" placeholder="Serviço">
                        </div>

                        <div class="w-1/2">
                            <label for="desk" class="label">Balcão de atendimento</label>
                            <input type="text" name="desk" id="desk" class="input w-full"
                                placeholder="Balcão de atendimento">
                        </div>
                    </div>

                    <div class="flex gap-4 mb-4">

                        <div class="w-full">
                            <label for="prefix" class="label">Prefixo</label>
                            <select name="prefix" id="prefix" class="input w-full">
                                <option value="-">Sem prefixo</option>
                            </select>
                        </div>

                        <div class="w-full">
                            <label for="total_digits" class="label">Total de dígitos</label>
                            <select name="total_digits" id="total_digits" class="input w-full">
                                <option value="2" selected>00</option>
                                <option value="3">000</option>
                                <option value="4">0000</option>
                            </select>
                        </div>

                        <div class="w-full">
                            <label for="status" class="label">Estado</label>
                            <select name="status" id="status" class="input w-full">
                                <option value="active" selected>Ativa</option>
                                <option value="inactive">Inativa</option>
                            </select>
                        </div>

                    </div>

                    <div class="mb-4">
                        <p class="label">Código de hash</p>
                        <div class="flex gap-2">
                            <p class="input bg-slate-100 w-full" id="hash_code">&nbsp;</p>
                            <button type="button" class="btn"><i class="fa-solid fa-rotate"></i></button>
                        </div>
                    </div>

                    <div class="main-card flex !p-4 mb-4">

                        <div class="w-1/2">
                            <div class="mb-4">
                                <label class="label">Prefixo - Cor de fundo</label>
                                <input type="text" class="input text-zinc-900" name="color_1" id="color_1"
                                    value="#0d3561">
                            </div>
                            <div>
                                <label class="label">Prefixo - Cor do texto</label>
                                <input type="text" class="input text-zinc-900" name="color_2" id="color_2"
                                    value="#ffffff">
                            </div>
                        </div>

                        <div class="w-1/2">
                            <div class="mb-4">
                                <label class="label">Número - Cor de fundo</label>
                                <input type="text" class="input text-zinc-900" name="color_3" id="color_3"
                                    value="#adb4b9">
                            </div>
                            <div>
                                <label class="label">Número - Cor do texto</label>
                                <input type="text" class="input text-zinc-900" name="color_4" id="color_4"
                                    value="#011020">
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn"><i class="fa-solid fa-check me-2"></i>Criar nova fila</button>

                </form>

            </div>

            <div class="flex w-1/2 justify-center items-center">
                <div id="color_preview" class="flex main-card">
                    <p id="example_prefix" class="rounded-tl-2xl rounded-bl-2xl text-center text-9xl font-bold p-6"
                        style="background-color: #0d3561; color: #ffffff;">A</p>
                    <p id="example_number" class="rounded-tr-2xl rounded-br-2xl text-center text-9xl font-bold p-6"
                        style="background-color: #adb4b9; color: #011020;">01</p>
                </div>
            </div>

        </div>

    </div>

    <script>
        // add coloris to all color input
        Coloris({ el: '#color_1',alpha: false,defaultColor: '#0d3561'});
        Coloris({ el: '#color_2',alpha: false,defaultColor: '#ffffff'});
        Coloris({ el: '#color_3',alpha: false,defaultColor: '#adb4b9'});
        Coloris({ el: '#color_4',alpha: false,defaultColor: '#011020'});
    </script>

</x-layouts.auth-layout>