<div class="mx-auto max-w-2xl divide-y divide-gray-900/10 px-6 pb-8 sm:pb-24 sm:pt-12 lg:max-w-7xl lg:px-8 lg:pb-32">
    <h2 class="text-2xl font-bold leading-10 tracking-tight text-gray-900">Perguntas frequentes</h2>
    <dl class="mt-10 space-y-8 divide-y divide-gray-900/10">
        <div x-data="{ open: false }" class="pt-8 lg:grid lg:grid-cols-12 lg:gap-8">
            <dt @click="open = !open" class="text-base font-semibold leading-7 text-gray-900 lg:col-span-5 hover:cursor-pointer">Plano de assinatura</dt>
            <dd x-show="open" x-transition.duration.500ms class="mt-4 lg:col-span-7 lg:mt-0" style="display: none;">
                <p class="text-base leading-7 text-gray-600">Você terá acesso a todas as funcionalidades do My Finance.<br><br> Lembrando que a cobrança ocorre anualmente, mas você pode parcelar esse valor em até doze vezes no cartão. </p>
            </dd>
        </div>
        <div x-data="{ open: false }" class="pt-8 lg:grid lg:grid-cols-12 lg:gap-8">
            <dt @click="open = !open" class="text-base font-semibold leading-7 text-gray-900 lg:col-span-5 hover:cursor-pointer">Garantia</dt>
            <dd x-show="open" x-transition.duration.500ms class="mt-4 lg:col-span-7 lg:mt-0" style="display: none;">
                <p class="text-base leading-7 text-gray-600">Oferecemos uma garantia incondicional de 7 dias. Sendo assim, você pode entrar, acessar o conteúdo e, se não se adaptar, entender que não é para você naquele momento ou até mesmo se arrepender nos primeiros 7 sete dias, pode solicitar o reembolso dentro desse prazo e nós devolveremos 100% do valor investido. Simples assim, sem complicação ou letras miúdas.</p>
            </dd>
        </div>
        <div x-data="{ open: false }" class="pt-8 lg:grid lg:grid-cols-12 lg:gap-8">
            <dt @click="open = !open" class="text-base font-semibold leading-7 text-gray-900 lg:col-span-5 hover:cursor-pointer">Como acessar</dt>
            <dd x-show="open" x-transition.duration.500ms class="mt-4 lg:col-span-7 lg:mt-0" style="display: none;">
                <p class="text-base leading-7 text-gray-600">Após realizar a sua assinatura e o pagamento ter sido confirmado com sucesso, você receberá o acesso ao nosso portal com o seu login e senha por e-mail.
                    <br> <br>
                    Você poderá acessar o portal pelo link que receber via e-mail ou clicar em Login, no topo da página do site. Caso encontre qualquer dificuldade com a senha, é só utilizar a função Esqueceu sua senha?.
                </p>
            </dd>
        </div>
        <div x-data="{ open: false }" class="pt-8 lg:grid lg:grid-cols-12 lg:gap-8">
            <dt @click="open = !open" class="text-base font-semibold leading-7 text-gray-900 lg:col-span-5 hover:cursor-pointer">Formas de pagamento</dt>
            <dd x-show="open" x-transition.duration.500ms class="mt-4 lg:col-span-7 lg:mt-0" style="display: none;">
                <p class="text-base leading-7 text-gray-600">
                    Trabalhamos com as seguintes formas de pagamento: <br><br>
                        - Pix <br>
                        - Boleto à vista <br>
                        - Cartão de crédito em até 12x <br>
                </p>
            </dd>
        </div>
    </dl>
</div>
