<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Българските Зеленчуци REST-API</title>
    <!--    css-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .parameter {
            font-style: italic;
        }

        .method {
            font-style: italic;
            font-weight: bolder;
        }

        .access {
            font-style: italic;
            color: #2a9055;
        }
    </style>
    <!--    <link href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

    <!--    scripts-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>


</head>
<body>
<div class="container">
    <br>
    <h6>code – UUID - номерът на всеки потребител или администратор,</h6>
    <h6>Тук не се разглежда случая как се регистрират в системата - </h6>
    <h6>super Admin - праща по майл паролите и кодовете :)</h6>
    <hr>
    <br>
    <table class="table table-bordered table-striped table-sm responsive">
        <thead>
        <tr>
            <th scope="col" style="width: 20%">End Point</th>
            <th scope="col" style="width: 35%">Description</th>
            <th scope="col" style="width: 25%">Result</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row"><a href="/home">api/{code}/articles<br><span class="parameter">[?tag={име на таг}]</span> </a>
            </th>
            <td><span class="access">достъпен за всички регистрирани</span><br> method <span class="method">GET</span>
                списък на наличните статии.<br>
                [tag - незадължителен параметър] - намира всички статии с този таг
            </td>
            <td>връща списък на всички статии <br> <span
                    class="parameter">[или списък на всички, които съдържат tag]</span></td>
        </tr>
        <tr>
            <th scope="row"><a href="/home">api/{code}/articles<br><span class="parameter">?title={име на статия}<br>[?body={текст на статия}]</span> </a></th>
            <td><span class="access">достъпен само за admin</span><br> method <span class="method">POST</span><br>създава нова статия
            </td>
            <td>връща пълната информация за новосъздадената сатия</td>
        </tr>
        <tr>
            <th scope="row">
                <a href="/home">api/{code}/articles/{article}<br>
                </a>
            </th>
            <td><span class="access">достъпен за всички регистрирани</span><br>method <span class="method">GET</span><br></td>
            <td>връща пълната информация за избраната статия</td>
        </tr>
        <tr>
            <th scope="row">
                <a href="/home">
                    api/{code}/articles/{article}<br>
                    ?title={име на статия}<br>
                    ?body={текст на статия}
                </a>
            </th>
            <td>
                <span class="access">достъпен само за admin</span><br>
                method <span class="method">PUT</span><br>
                поне единия от двата параметъра е задължителен<br>
                обновява - променя статия и/или заглавие
            </td>
            <td> връща пълната информация за редактираната статия</td>
        </tr>
        <tr>
            <th scope="row">
                <a href="/home">
                    api/{code}/articles/{article}
                </a>
            </th>
            <td>
                <span class="access">достъпен само за admin</span><br>
                method <span class="method">DELETE</span><br>
                изтрива статия с номер {article}
            </td>
            <td> връща пълната информация за изтритата статия</td>
        </tr>
        <tr>
            <th scope="row">
                <a href="/home">api/{code}/articles/{article}/comments <br>
                    ?comment={тескт на коментара}<br>
                </a>
            </th>
            <td>
                <span class="access">достъпен за всички регистрирани</span><br>
                method <span class="method">POST</span><br>
                параметъра е задължителен<br>
                създава коментар към статия
            </td>
            <td>връща пълната информация за коментираната статия</td>
        </tr>
        <tr>
            <th scope="row">
                <a href="/home">api/{code}/articles/{article}/image<br>
                    ?image={илюстрация към статията}<br>
                </a>
            </th>
            <td>
                <span class="access">достъпен само за admin</span><br>
                method <span class="method">POST</span><br>
                параметъра е задължителен<br>
                добавя илюстрация към статия с номер {article}
            </td>
            <td>връща пълната информация за променената статия</td>
        </tr>
        <tr>
            <th scope="row">
                <a href="/home">api/{code}/articles/{article}/tag<br>
                    ?tag={таг към статията}<br>
                </a>
            </th>
            <td>
                <span class="access">достъпен само за admin</span><br>
                method <span class="method">POST</span><br>
                параметъра е задължителен<br>
                добавя таг към статия с номер {article}
            </td>
            <td>връща пълната информация за променената статия</td>
        </tr>
        <tr>
            <th scope="row">
                <a href="/home">api/{code}/articles/{article}/tag/{tag}<br>
                </a>
            </th>
            <td>
                <span class="access">достъпен само за admin</span><br>
                method <span class="method">DELETE</span><br>
                откача таг от статия с номер {article}
            </td>
            <td>връща пълната информация за променената статия</td>
        </tr>
        <tr>
            <th scope="row">
                <a href="/home">api/{code}/comments/{comment}<br>
                    ?comment={тескт на коментара}<br>
                </a>
            </th>
            <td>
                <span class="access">достъпен за admin и за потребителя създал коментара</span><br>
                method <span class="method">PUT</span><br>
                параметъра е задължителен<br>
                променя коментар
            </td>
            <td>връща пълната информация за променения коментар</td>
        </tr>
        <tr>
            <th scope="row">
                <a href="/home">api/{code}/comments/{comment}<br>
                </a>
            </th>
            <td>
                <span class="access">достъпен за admin и за потребителя създал коментара</span><br>
                method <span class="method">DELETE</span><br>
                заличава коментар
            </td>
            <td>връща пълната информация за променената статия</td>
        </tr>
        <tr>
            <th scope="row">
                <a href="/home">api/{code}/image/{image}<br>
                </a>
            </th>
            <td>
                <span class="access">достъпен само за admin</span><br>
                method <span class="method">DELETE</span><br>
                заличава илюстрация към стътия
            </td>
            <td>връща пълната информация за променената статия</td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
