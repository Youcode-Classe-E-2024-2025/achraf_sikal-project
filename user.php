<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Projects</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .blue-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #1d4ed8;  /* Bleu intense */
            color: white;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .blue-button:hover {
            background-color: #1e40af;  /* Bleu plus foncé au survol */
            transform: scale(1.05);     /* Effet de zoom subtil */
        }

        .blue-button:active {
            background-color: #1e3a8a;  /* Bleu encore plus foncé lorsqu'appuyé */
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .project-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .project-item {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            transition: box-shadow 0.3s ease;
        }

        .project-item:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .project-item a {
            text-decoration: none;
            color: #333;
            font-size: 20px;
            font-weight: bold;
        }

        .status {
            margin: 10px 0;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>

    <a href="./newproject.php" class="blue-button">Creat new project</a>

    <div class="container">
        <div class="project-list">
            <!-- Dynamically loaded project links -->
            <?php 
                include_once("./database/Database.php");
                $taskInfo;
                $connect = (new Database)->db;
                $project = $connect->query("SELECT * FROM projects;");
                while ($projects = $project->fetch(PDO::FETCH_ASSOC)) {
                    // echo '<option value="'.$tasks["user_id"].'">'.$tasks["email"].'</option>';
                    echo '<div class="project-item">
                            <a href="project_details.php?project_id=1">Mobile App Development</a>
                            <p class="status">Status: Active</p>
                        </div>';
                }
            ?>
            <div class="project-item">
                <a href="project_details.php?project_id=1">Mobile App Development</a>
                <p class="status">Status: Active</p>
            </div>

            <div class="project-item">
                <a href="index.php?project_id=2">Marketing Campaign</a>
                <p class="status">Status: Planned</p>
            </div>

            <div class="project-item">
                <a href="project_details.php?project_id=3">Website Redesign</a>
                <p class="status">Status: On Hold</p>
            </div>
        </div>
    </div>

</body>
</html>
