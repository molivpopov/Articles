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
    <h6>code – UUID - номерът на всеки потрелител или администратор,</h6>
    <h6>Тук не се разглежда случая как се регистрират в системата - </h6>
    <h6>super Admin - а праща по майл паролите и кодовете :)</h6>
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
            <th scope="row"><a href="space">/{code}/articles<br><span class="parameter">[?tag={име на таг}]</span> </a>
            </th>
            <td><span class="access">достъпен за всички регистрирани</span><br> method <span class="method">GET</span>
                списък на наличните статии. Незадължителен парамитър: [tag={име на таг}]
            </td>
            <td>връща списък на всички статии <br> <span
                    class="parameter">[или списък на всички, които съдържат tag]</span></td>
        </tr>
        <tr>
            <th scope="row"><a href="/home">/{code}/article<br><span class="parameter">?article_id={номер на сатия}</span> </a></th>
            <td><span class="access">достъпен за всички регистрирани</span><br> method <span class="method">GET</span>
                пълна информация за статия ?article_id={номер на сатия}
            </td>
            <td>връща пълната информация за сатия номер id</td>
        </tr>
        <tr>
            <th scope="row">
                <a href="/home">/{code}/article<br>
                    <span class="parameter">
                        [?article_id={номер на сатия}]<br>
                        [?title={заглавие на статия}]<br>
                        [?body={съдържание на статия}]<br>
                        [?tag={таг}]<br>
                        [?image={нова илюстрация}]<br>
                    </span>
                </a>
            </th>
            <td><span class="access">достъпен само за администратори</span><br>method <span class="method">POST</span><br>всички параметри са незадължителни: ако има номер на статия, значи редактираме съществуваща, ако няма - добавяме нова сатия. Съществуващите параметри заменят съответното съдържание в съществуващата статия. Ако има параметър image - добавя картинка към статията.</td>
            <td>връща пълната информация за променената статия</td>
        </tr>
        <tr>
            <th scope="row">
                <a href="/home">
                    /{code}/comment<br>
                    ?article_id={номер на статия}<br>
                    ?comment={съдържание на коментара}
                </a>
            </th>
            <td>
                <span class="access">достъпен за всички регистрирани</span><br>
                method <span class="method">PUT</span><br>
                параметрите са задължителни
            </td>
            <td> връща пълното описание на коментара</td>
        </tr>
        <tr>
            <th scope="row">
                <a href="/home">/{code}/image<br>
                    ?article_id={номер на статия}<br>
                    ?image_id={номер на илюстрация}
                </a>
            </th>
            <td>
                <span class="access">достъпен само за администратори</span><br>
                method <span class="method">DELETE</span><br>
                параметрите са задължителни<br>
                премахва илюстрация от статия
            </td>
            <td>връща "true" ако успешно е премахната илюстрация (ако има такакава в тази статия), или "false" ако не е премахната</td>
        </tr>
        <tr>
            <th scope="row">
                <a href="/home">/{code}/tag<br>
                    ?article_id={номер на статия}<br>
                    ?tag={таг}
                </a>
            </th>
            <td>
                <span class="access">достъпен само за администратори</span><br>
                method <span class="method">DELETE</span><br>
                параметрите са задължителни<br>
                премахва таг от статия
            </td>
            <td>връща "true" ако успешно е премахнат таг (ако има такъв в тази статия), или "false" ако не е премахнат</td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
