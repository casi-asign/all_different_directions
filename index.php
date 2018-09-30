<?php require_once __DIR__ . '/vendor/autoload.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            textarea::-webkit-input-placeholder
            {
                color: gray;
            }
            textarea:-moz-placeholder
            {
                color: gray;
            }
            textarea::-moz-placeholder
            {
                color: gray;
            }
            textarea:-ms-input-placeholder
            {
                color: gray;
            }
        </style>
        <title>All different directions</title>
    </head>

    <body>
        <header style="text-align: center; background-color: springgreen;">
            <h1 style="padding: 20px 0;">My Kattis &mdash; All different directions</h1>
        </header>

        <main id="content">
            <div id="input_div" style="width: 49%; display: inline-block;">
                <form method="post">
                    <label for="input"><h2>Input:</h2></label>
                    <br>
                    <textarea name="input" id="input" cols="100" rows="20" placeholder="3&#x0a;87.342 34.30 start 0 walk 10.0&#x0a;2.6762 75.2811 start -45.0 walk 40 turn 40.0 walk 60&#x0a;58.518 93.508 start 270 walk 50 turn 90 walk 40 turn 13 walk 5&#x0a;2&#x0a;30 40 start 90 walk 5&#x0a;40 50 start 180 walk 10 turn 90 walk 5&#x0a;0"><?php echo $_POST['input'] ?? ''; ?></textarea>
                    <div>
                        <button id="submit" type="submit">Submit</button>
                        <button id="clear" type="button">Clear</button>
                    </div>
                </form>
            </div>
            <div id="output" style="width: 49%;  display: inline-block; vertical-align: top;">
            <?
                if(isset($_POST['input']) && $_POST['input'])
                {
            ?>
                <h2>Output:</h2>
                <p><?=(trim($_POST['input']))?App\Output::make($_POST['input'])->calculate():'No data input'?></p>
            <?
                }
            ?>
            </div>
        </main>

        <footer style="background-color: darkseagreen; padding: 10px; text-align: center; margin-top: 20px;">
            <p>Copyright &copy; My all different directions <?=date("Y")?></p>
        </footer>

        <script type="text/javascript">
            let clear = () =>
            {
                document.getElementById('input').value = '';
                document.getElementById('output').style.display = 'none';
            };
            document.getElementById('clear').onclick = clear;
            window.onkeydown = (event) =>
            {
                if(event.key === "Enter")
                {
                    if(event.ctrlKey || event.metaKey) document.getElementById('submit').click();
                }
                else if(event.key === "Escape") clear();
            }
        </script>
    </body>
</html>