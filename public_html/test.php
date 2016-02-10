<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>www.mcdrx-photographie.com</title>
        <link href="../admin/style-admin.css" rel="stylesheet" type="text/css" />
        <script src="../script/jquery.js" type="text/JavaScript"></script>
 
        <script  type="text/JavaScript">
 
        </script>
         
         
         
         
        <?php
     
            try
            {
                $bdd = new PDO('mysql:host=localhost;dbname=cession_public', 'root', '');
 
            }
            catch(Exception $e)
            {
                die('Erreur : ' . $e->getMessage());
            }          
            $reponse = $bdd->query('SELECT * FROM reportage_cession');
             
            //Ecriture du fichier XML
            $file= fopen("results.xml", "w");
            $_xml ="<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n";
            $_xml .="<site>\r\n";        
             
            while ($donnees = $reponse->fetch())
            {
                $_xml .="\t<id_xml id=\"" . $donnees["id"]."\">\r";
                $_xml .="\t\t<titre id=\"titre_" . $donnees["id"]."\">" .$donnees["titre"]."</titre>\r";
                $_xml .="\t\t<image id=\"image_" . $donnees["id"]."\">" .$donnees["image"]."</image>\r";
                $_xml .="\t\t<texte id=\"texte_" . $donnees["id"]."\">" .$donnees["texte"]."</texte>\r";
                $_xml .="\t\t<lien id=\"lien_" . $donnees["id"]."\">" .$donnees["lien"]."</lien>\r";   
                $_xml .="\t</id_xml>\t\r";            
            }
            $_xml .="</site>";
            fwrite($file, $_xml);
            fclose($file);
            $reponse->closeCursor(); // Termine le traitement de la requête
             
            ?>
             
            <script type="text/JavaScript">
            //lecture du fichier XML et ecriture sur HTML
            $(document).ready(function(){
                 
                $.ajax
                    ({
                        type: "GET",
                        url: "results.xml",
                        dataType: "xml",
                        complete: function(data, status)
                            {
                                var champ = data.responseXML;
                                var appendHtml = "";
                                $(champ).find('id_xml').each(function()
                                {
                                var id_xml = $(this).attr('id');
                                var titre = $(this).find('titre').text();
                                var image = $(this).find('image').text();
                                var texte = $(this).find('texte').text();
                                var lien = $(this).find('lien').text();
                                appendHtml +="<div id=\"cellule\" class=\"cellule\" onclick=\"clicktest("+id_xml+");\">ID : "+id_xml+"<br>titre : <br>"+titre+"<br>image :<br>"+image+"<br>texte :<br>"+texte+"<br>lien :<br>"+lien+"</div>";
                                });
                                $("#liste").append(appendHtml);
                            }
                    });
            });
        </script>
    </head>
     
        <body>
        <div id="contenu">
            <div id="liste">
            </div>
             
             
            <script type="text/JavaScript">
            //ecriture dans le form
                function clicktest(id_fonc)
                {
                 
                 
                $.ajax
                    ({
                        type: "GET",
                        url: "results.xml",
                        dataType: "xml",
                        success: function(xml)
                            {
                                var id_click = $(xml).find('id_xml[id='+id_fonc+']').attr('id');
                                var titre_click = $(xml).find('titre[id=titre_'+id_fonc+']').text();
                                var image_click = $(xml).find('image[id=image_'+id_fonc+']').text();
                                var texte_click = $(xml).find('texte[id=texte_'+id_fonc+']').text();
                                var lien_click = $(xml).find('lien[id=lien_'+id_fonc+']').text();
                                     
                                $('#id_form').val(id_click)
                                $('#texte_form').val(texte_click)
                                $('#titre_form').val(titre_click)
                                $('#url-img-pre_form').val(image_click)
                                $('#url-redir_form').val(lien_click)                           
                            }              
                    });
                }
             
            </script>
 
 
 
            <div id="formulaire">
                <form id="" method=post enctype="multipart/form-data">
                 
                    <label for="id">ID : </label><br><input id="id_form" name ="id_form" class="id_form" type="text" value=""><br><br>
                    <label for="url-img-pre">URL Image preview : </label><br><input id="url-img-pre_form" class="url-img-pre_form" type="text"><br><br>
                    <label for="titre">Titre: </label><br><input id="titre_form" class="titre_form" type="text"><br><br>
                    <label for="texte">Texte:</label><br><textarea id="texte_form" class="texte_form" col=""></textarea><br><br>
                    <label for="url-redir">URL de redir:</label><br><input id="url-redir_form" class="url-redir_form" type="text"><br><br>
                         
                </form>
            </div>
             
 
             
             
             
        </div>
         
         
         
         
        </body>
</html>