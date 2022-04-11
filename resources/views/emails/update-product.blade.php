<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h1>
        Actualización del producto {{ $productID }} ({{ $productSource }})
    </h1>
    @if (count($changes) > 0)
        @foreach ($changes as $change)
            <ul class="mt-4">
                <li>
                    Field: {{ $change['field'] }}
                </li>
                <li>
                    Old Value: {{ $change['old_value'] }}
                </li>
                <li>
                    New Value: {{ $change['new_value'] }}
                </li>
            </ul>
        @endforeach
    @endif
</body>
</html>