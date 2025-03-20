<x-filament-panels::page>
    @if(!empty($this->car))
        <div class="space-y-3">
            <dl class="flex flex-col sm:flex-row gap-1">
                <dt class="min-w-40">
                    <span class="block text-sm text-gray-500 dark:text-neutral-500">Valor:</span>
                </dt>
                <dd>
                    <ul>
                        <li class="me-1 after:content-[','] inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">
                            {{$this->car['Valor']}} ({{$this->car['MesReferencia']}})
                        </li>
                    </ul>
                </dd>
            </dl>

            <dl class="flex flex-col sm:flex-row gap-1">
                <dt class="min-w-40">
                    <span class="block text-sm text-gray-500 dark:text-neutral-500">Marca:</span>
                </dt>
                <dd>
                    <ul>
                        <li class="me-1 after:content-[','] inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">
                            {{$this->car['Marca']}}
                        </li>
                    </ul>
                </dd>
            </dl>

            <dl class="flex flex-col sm:flex-row gap-1">
                <dt class="min-w-40">
                    <span class="block text-sm text-gray-500 dark:text-neutral-500">Modelo:</span>
                </dt>
                <dd>
                    <ul>
                        <li class="me-1 after:content-[','] inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">
                            {{$this->car['Modelo']}}
                        </li>
                    </ul>
                </dd>
            </dl>

            <dl class="flex flex-col sm:flex-row gap-1">
                <dt class="min-w-40">
                    <span class="block text-sm text-gray-500 dark:text-neutral-500">Ano Modelo:</span>
                </dt>
                <dd>
                    <ul>
                        <li class="me-1 after:content-[','] inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">
                            {{$this->car['AnoModelo']}}
                        </li>
                    </ul>
                </dd>
            </dl>

            <dl class="flex flex-col sm:flex-row gap-1">
                <dt class="min-w-40">
                    <span class="block text-sm text-gray-500 dark:text-neutral-500">Combustível:</span>
                </dt>
                <dd>
                    <ul>
                        <li class="me-1 after:content-[','] inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">
                            {{$this->car['Combustivel']}} - {{$this->car['SiglaCombustivel']}}
                        </li>
                    </ul>
                </dd>
            </dl>

            <dl class="flex flex-col sm:flex-row gap-1">
                <dt class="min-w-40">
                    <span class="block text-sm text-gray-500 dark:text-neutral-500">Código Fipe:</span>
                </dt>
                <dd>
                    <ul>
                        <li class="me-1 after:content-[','] inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">
                            {{$this->car['CodigoFipe']}}
                        </li>
                    </ul>
                </dd>
            </dl>
        </div>
        <!-- End List -->

    @endif

</x-filament-panels::page>
