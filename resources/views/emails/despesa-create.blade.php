@component('mail::message')
# Detalhes da Despesa

**Descrição:** {{$despesa->descricao}} <br/>
**Data:** {{$despesa->data}} <br/>
**Valor:** R${{ number_format($despesa->valor, 2, ',', '.') }}

{{ config('app.name') }}
@endcomponent