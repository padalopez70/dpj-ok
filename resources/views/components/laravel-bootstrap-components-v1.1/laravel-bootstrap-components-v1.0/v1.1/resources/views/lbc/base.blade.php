<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="author" content="Markus Zundel">
  <meta name="description" content="{{ $data['meta']['description'] ?? 'Laravel Bootstrap Components is a starter kit for Laravel with Bootstrap + Blade designed specifically for developers' }}">
  <title>{{ isset($data['meta']['title']) ? $data['meta']['title'] . ' | ' : '' }}Laravel Bootstrap Components</title>
  <link href="{{ url('lbc-docs.min.css') }}" rel="stylesheet" type="text/css">

  <link rel="canonical" href="{{ url()->current() }}">

  <style type="text/css">
    code[class*="language-"],
    pre[class*="language-"] {
      color: black;
      background: none;
      text-shadow: 0 1px white;
      font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
      font-size: 1em;
      text-align: left;
      white-space: pre;
      word-spacing: normal;
      word-break: normal;
      word-wrap: normal;
      line-height: 1.5;

      -moz-tab-size: 4;
      -o-tab-size: 4;
      tab-size: 4;

      -webkit-hyphens: none;
      -moz-hyphens: none;
      -ms-hyphens: none;
      hyphens: none;
    }

    pre[class*="language-"]::-moz-selection, pre[class*="language-"] ::-moz-selection,
    code[class*="language-"]::-moz-selection, code[class*="language-"] ::-moz-selection {
      text-shadow: none;
      background: #b3d4fc;
    }

    pre[class*="language-"]::selection, pre[class*="language-"] ::selection,
    code[class*="language-"]::selection, code[class*="language-"] ::selection {
      text-shadow: none;
      background: #b3d4fc;
    }

    @media print {
      code[class*="language-"],
      pre[class*="language-"] {
        text-shadow: none;
      }
    }

    /* Code blocks */
    pre[class*="language-"] {
      padding: 1em;
      margin: .5em 0;
      overflow: auto;
    }

    :not(pre) > code[class*="language-"],
    pre[class*="language-"] {
      background: #f5f2f0;
    }

    /* Inline code */
    :not(pre) > code[class*="language-"] {
      padding: .1em;
      border-radius: .3em;
      white-space: normal;
    }

    .token.comment,
    .token.prolog,
    .token.doctype,
    .token.cdata {
      color: slategray;
    }

    .token.punctuation {
      color: #999;
    }

    .namespace {
      opacity: .7;
    }

    .token.property,
    .token.tag,
    .token.boolean,
    .token.number,
    .token.constant,
    .token.symbol,
    .token.deleted {
      color: #905;
    }

    .token.selector,
    .token.attr-name,
    .token.string,
    .token.char,
    .token.builtin,
    .token.inserted {
      color: #690;
    }

    .token.operator,
    .token.entity,
    .token.url,
    .language-css .token.string,
    .style .token.string {
      color: #9a6e3a;
      background: hsla(0, 0%, 100%, .5);
    }

    .token.atrule,
    .token.attr-value,
    .token.keyword {
      color: #07a;
    }

    .token.function,
    .token.class-name {
      color: #DD4A68;
    }

    .token.regex,
    .token.important,
    .token.variable {
      color: #e90;
    }

    .token.important,
    .token.bold {
      font-weight: bold;
    }

    .token.italic {
      font-style: italic;
    }

    .token.entity {
      cursor: help;
    }
  </style>

  @if(request()->getHost() === 'laravel-bootstrap-components.com')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-146285562-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }

      gtag('js', new Date());

      gtag('config', 'UA-146285562-1');
    </script>
  @endif

  @stack('head')
</head>
<body>

<div class="container">
  <nav class="navbar navbar-expand-md navbar-light mb-5 mb-md-4 px-0 d-block d-md-flex text-center text-md-left">
    <a class="navbar-brand" href="{{ route('homepage') }}"><strong>Lbc</strong></a>

    <hr class="d-md-none">

      <ul class="navbar-nav ml-md-0 mr-auto text-left" style="z-index:1021">
        <li class="nav-item dropdown text-uppercase">
          <a class="nav-link dropdown-toggle" href="#" id="componentsDropdown" data-toggle="dropdown" aria-expanded="false">
            Components
          </a>

          <div class="dropdown-menu border-0 bg-gray-200" aria-labelledby="componentsDropdown" style="margin:0 -15px">
            @foreach($navbar[0]['childs'] as $item)
              <x-link :all="$item['link']" :class="'dropdown-item' . (Request::url() == $item['link']['href'] ? ' active' : '')"/>
            @endforeach
          </div>
        </li>

        <li class="nav-item dropdown text-uppercase">
          <a class="nav-link dropdown-toggle" href="#" id="examplesDropdown" data-toggle="dropdown" aria-expanded="false">
            Examples
          </a>

          <div class="dropdown-menu border-0 bg-gray-200" aria-labelledby="examplesDropdown" style="margin:0 -15px">
            @foreach($navbar[1]['childs'] as $item)
              <x-link :all="$item['link']" :class="'dropdown-item' . (Request::url() == $item['link']['href'] ? ' active' : '')"/>
            @endforeach
          </div>
        </li>

        <li class="nav-item dropdown text-uppercase">
          <a class="nav-link dropdown-toggle" href="#" id="examplesDropdown" data-toggle="dropdown" aria-expanded="false">
            Themes
          </a>

          <div class="dropdown-menu border-0 bg-gray-200" aria-labelledby="examplesDropdown" style="margin:0 -15px">
            @foreach($navbar[2]['childs'] as $item)
              <x-link :all="$item['link']" :class="'dropdown-item' . (Request::url() == $item['link']['href'] ? ' active' : '')"/>
            @endforeach
          </div>
        </li>

        <li class="nav-item dropdown text-uppercase">
          <a class="nav-link text-green" href="{{ $navbar[3]['link']['href'] }}">
            {{ $navbar[3]['link']['text'] }}
          </a>
        </li>
      </ul>

      <ul class="navbar-nav ml-md-auto text-left">
        <li class="nav-item dropdown text-uppercase">
          <a class="nav-link" href="https://laravel-bootstrap-components.com/contact">
            Contact
          </a>
        </li>
      </ul>
  </nav>
</div>

@yield('page-content')

<footer class="bg-lighter text-muted mt-5 small">
  <div class="container p-3 p-md-5">
    <ul class="list-inline">
      <li class="list-inline-item">
        <a href="https://twitter.com/ZundelWebdesign" class="text-body" target="_blank">Twitter</a>
      </li>

      <li class="list-inline-item">
        <a href="https://www.facebook.com/ZundelWebdesignDE/" class="text-body" target="_blank">Facebook</a>
      </li>

      <li class="list-inline-item">
        <a href="https://www.zundel-webdesign.de" class="text-body" target="_blank">Zundel-Webdesign</a>
      </li>

      <li class="list-inline-item">
        <a href="https://shop.zundel-webdesign.de" class="text-body" target="_blank">Shop</a>
      </li>
    </ul>

    <p>
      Templates are available here: <a href="https://shop.zundel-webdesign.de/">Shop</a><br>
      Designed and built by &copy; {{ date('Y') }} Zundel-Webdesign
    </p>
  </div>
</footer>

<script src="{{ url('js/app.js') }}" defer></script>
<script>
  const codeExamples = document.querySelectorAll('.code-example')

  codeExamples.forEach(function (codeExample) {
    let collapseState = codeExample.querySelector('[data-toggle="collapse"]')
    let dataTabContent = codeExample.querySelector('.tab-pane.data')
    let dataTab = codeExample.querySelector('.nav-item.data')

    if (!dataTabContent) {
      dataTab.style.display = 'none'
    }

    collapseState.addEventListener('click', () => {
      if (collapseState.innerText === 'Show code') {
        collapseState.innerText = 'Hide code'
      } else if (collapseState.innerText === 'Hide code') {
        collapseState.innerText = 'Show code'
      }
    }, false)
  })
</script>
@stack('js')
</body>
</html>
