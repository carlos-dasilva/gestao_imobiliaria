@extends('layouts.app')

@section('title','Termos de Uso')

@section('content')
<h2 class="mb-3">Termos de Uso</h2>
<p>Ao acessar este site, você concorda com os termos abaixo. Leia atentamente.</p>

<h4>1. Serviços</h4>
<p>Este site divulga imóveis e oferece atendimento prestado por uma corretora de imóveis autônoma. As informações podem ser fornecidas por proprietários e parceiros e estão sujeitas à verificação.</p>

<h4>2. Responsabilidades</h4>
<ul>
  <li>O usuário deve fornecer dados verdadeiros e atualizados ao entrar em contato.</li>
  <li>Não me responsabilizo por indisponibilidades temporárias por manutenção ou força maior.</li>
  <li>Reservo-me o direito de atualizar conteúdo, preços e disponibilidade sem aviso prévio.</li>
  </ul>

<h4>3. Propriedade intelectual</h4>
<p>Textos, logotipos, imagens e conteúdos são protegidos por direitos autorais e marcas. É vedada a reprodução sem autorização.</p>

<h4>4. Comunicações</h4>
<p>Você poderá receber e-mails ou mensagens transacionais relacionadas a suas solicitações e propostas.</p>

<h4>5. Privacidade</h4>
<p>O tratamento de dados pessoais segue a <a href="{{ route('privacy') }}">Política de Privacidade</a>.</p>

<h4>6. Foro</h4>
<p>Fica eleito o foro da comarca de sua sede para dirimir eventuais controvérsias, com renúncia a qualquer outro.</p>
@endsection
