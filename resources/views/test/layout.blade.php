<html>

<head>
    <style>
        /**
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
        @page {
            margin: 0cm 0cm;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 2.2cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 2.2cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;

            /** Extra personal styles **/
            background-color: #8c9da4;
            color: black;
            text-align: center;
            line-height: 1.5cm;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1.5cm;

            /** Extra personal styles **/
            border-top:  solid 1mm #8c9da4;
            color: black;
            text-align: center;
            line-height: 1cm;

        }

        /** insulae **/
        /* pageS no funciona en dompdf */
        /* agregar un id="pageFooter" si se quiere mostrar */
        /* #pageFooter:after {
            content: counter(page) counter(pages)
        } */

    </style>
</head>

<body>
    <!-- Define header and footer blocks before your content -->
    <header>
        @yield('header')
    </header>

    <footer>
        @yield('footer')
    </footer>

    <!-- Wrap the content of your PDF inside a main tag -->
    <main>
        @yield('contenido')
    </main>
</body>

</html>
