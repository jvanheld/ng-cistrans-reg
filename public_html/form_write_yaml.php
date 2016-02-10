<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Amidex Home Project</title>

		<link rel="stylesheet" type="text/css" href="mise_en_page.css">

        <script type="text/javascript" src="jQuery/jquery-1.12.0.js"></script>
        <script type="text/javascript" src="js/function.js"></script>

	</head>

	<body>
		<h1>Formulaire d'annotation des données</h1>

		
		<div>
			<form id="form-yaml" action="write_yaml.php"  method="post">
				
				<fieldset>
				    <legend>Series</legend>
				<p>This section describes the overall experiment</p>

				<label for= "Title_sreries"><a href="#" class="info">Title_sreries<span>Unique title (less than 255 characters) that describes the overall study.</span></a></label>
				<input type='text' name="Series_information[Title_sreries]" id="Title_sreries" value="" ><br>

				<label for='Summary'><a href="#" class="info">Summary<span>Thorough description of the goals and objectives of this study. The abstract from the associated publication may be suitable. Include as much text as necessary.</span></a></label>
				<input type='text' name="Series_information[Summary]" id='Summary' value=""><br>

				<label for="Overall_design"><a href="#" class="info">Overall design<span>Indicate how many Samples are analyzed, if replicates are included, are there control and/or reference Samples, etc...</span></a></label>
				<input type='text' name="Series_information[Overall_design]" id="Overall_design" value=""><br>

				<table class="dTable" id='Contributor_table'>
				<tbody>
                    <tr id="Contributor_clone_td">
                        <td  class="Contributor"><label for= "Contributor"><a href="#" class="info">Contributor<span>"Firstname,Initial,Lastname".Example: "John,H,Smith" or "Jane,Doe". Each contributor on a separate case, add as many contributor cases as required.</span></a></label> <input type='text' name="Series_information[Contributor][]" id="Contributor_clone" value="" ></td>
                        <td id="action"><a href="#" onclick="delLigne(this); return false;">Delete this contributor</a>
                    </tr>
					<tr>
                        <td class="Contributor"><label for= "Contributor"><a href="#" class="info">Contributor<span>"Firstname,Initial,Lastname".Example: "John,H,Smith" or "Jane,Doe". Each contributor on a separate case, add as many contributor cases as required.</span></a></label> <input type='text' name="Series_information[Contributor][]" id="Contributor" value="" ></td>
						<td id="action"><a href="#" onclick="delLigne(this); return false;">Delete this contributor</a>
					</tr>
				</tbody>
				
				<tfoot>
					<tr>
						<th colspan="5"><a href="#!" id="addContributor">Add a contributor</a></th>
					</tr>
				</tfoot>
				
				</table>

				<label for= "Supplementary_file"><a href="#" class="info">Supplementary file<span>[optional] If you submit a matrix table containing processed data for all samples, include the file name here.</span></a></label>
				<input type='text' name="Series_information[Supplementary_file]" id="Supplementary_file" value="" ><br>

				<label for= "SRA_center_name_code"><a href="#" class="info">SRA_center_name_code<span>[optional] If you submit a matrix table containing processed data for all samples, include the file name here.</span></a></label>
				<input type='text' name="Series_information[SRA_center_name_code]" id="SRA_center_name_code" value="" ><br>
				
				</fieldset>

				<fieldset>
				    <legend>Samples</legend>
				<p>This section lists and describes each of the biological Samples under investgation, as well as any protocols that are specific to individual Samples.</p>
				<p>Additional "processed data file" or "raw file" columns may be included.</p>

				<table class="dynatable" id="sample_table">
				<thead>
					<tr>
						<th><a href="#" class="info">Sample_name<span>An arbitrary and unique identifier for each sample. This information will not appear in the final records and is only used as an internal reference. Each row represents a GEO Sample record.</span></a></th>
                        <th><a href="#" class="info">Title<span>Unique title that describes the Sample.</span></a></th>
						<th><a href="#" class="info">Source_name<span>Briefly identify the biological material e.g., vastus lateralis muscle.</span></a></th>
						<th><a href="#" class="info">Organism<span>Identify the organism(s) from which the sequences were derived.</span></a></th>
						<th><a href="#" class="info">Molecule<span>Type of molecule that was extracted from the biological material. Include one of the following: total RNA, polyA RNA, cytoplasmic RNA, nuclear RNA, genomic DNA, protein, or other.</span></a></th>
						<th><a href="#" class="info">Description<span>Type of molecule that was extracted from the biological material. Include one of the following: total RNA, polyA RNA, cytoplasmic RNA, nuclear RNA, genomic DNA, protein, or other.</span></a></th>
                        <th><a href="#" class="info">Processed_data_file<span>Name of the file containing the processed data. Multiple 'processed data file' columns may be included when multiple processed data files exist for a Sample (as presented in EXAMPLE 1 worksheet).</span></a></th>
                        <th><a href="#" class="info">Raw_file<span>The name of the files containing the raw data.Additional 'raw data file' columns may be included if more than 1 raw data file exist for a Sample</span></a></th>
                        <th id="colRef">Actions</th>
					</tr>
				</thead>
				
				<tbody>
					<tr id="Data" >
						<td class="Sample_name"><input id="Sample_name" type="text" name="Samples_information[Sample_name][]" /></td>
						<td class="Title"><input id="Title" type="text" name="Samples_information[Title][]" /></td>
						<td class="Source"><input id="Source" type="text" name="Samples_information[Source][]" /></td>
						<td class="Organism"><input id="Organism" type="text" name="Samples_information[Organism][]" /></td>
                        <td class="Molecule"><input id="Molecule" type="text" name="Samples_information[Molecule][]" /></td>
                        <td class="Description"><input id="Description" type="text" name="Samples_information[Description][]" /></td>
                        <td class="Processed_data_file"><input id="Processed_data_file" type="text" name="Samples_information[Processed_data_file][]" /></td>
                        <td class="Raw_file"><input id="Raw_file" type="text" name="Samples_information[Raw_file][]" /></td>
                        <td id="action_function"><a href="#" onclick="delLigne(this); return false;">Delete line</a>
                            <button form="form-yaml" id="addColButton" type="button">Add Column</button>
							<button form="form-yaml" id="delColButton" type="button">Delete Column</button>
						</td>
					</tr>
				</tbody>
				
				<tfoot>
					<tr>
                        <th colspan="8"><a href="#!" id="action_addLine"> Add line</a></th>
					</tr>
				</tfoot>
				
				</table>
				</fieldset>
				
				<fieldset>
				    <legend>Protocols</legend>
				<p> Any of the protocols below which are applicable to only a subset of Samples should be included as additional columns of the SAMPLES section instead.</p>
				
				<label for= "Growth_protocol"><a href="#" class="info">Growth_protocol<span>[Optional]  Describe the conditions that were used to grow or maintain organisms or cells prior to extract preparation.</span></a></label>
				<input size= '150' type='text' name="Protocols_information[Growth_protocol]" id="Growth_protocol" value="" ><br>
				
				<label for= "Treatment_protocol"><a href="#" class="info">Treatment_protocol<span>[Optional] Describe the treatments applied to the biological material prior to extract preparation.</span></a></label>
				<input size= '150' type='text' name="Protocols_information[Treatment_protocol]" id="Treatment_protocol" value="" ><br>
				
				<label for= "Extract_protocol"><a href="#" class="info">Extract_protocol<span>Describe the protocols used to extract and prepare the material to be sequenced. </span></a></label>
				<input size= '150' type='text' name="Protocols_information[Extract_protocol]" id="Extract_protocol" value="" ><br>
				
				<label for= "Library_construction_protocol"><a href="#" class="info">Library_construction_protocol<span>Describe the library construction protocol.</span></a></label>
				<input size= '150' type='text' name="Protocols_information[Library_construction_protocol]" id="Library_construction_protocol" value="" ><br>
				
				<label for= "Library_strategy"><a href="#" class="info">Library_strategy<span>A Short Read Archive-specific field that describes the sequencing technique for this library. Please select one of the following terms: RNA-Seq miRNA-Seq ncRNA-Seq RNA-Seq (CAGE) RNA-Seq (RACE) ChIP-Seq MNase-Seq MBD-Seq MRE-Seq Bisulfite-Seq Bisulfite-Seq (reduced representation) MeDIP-Seq DNase-Hypersensitivity Tn-Seq FAIRE-seq SELEX RIP-Seq ChIA-PET OTHER</span></a></label>
				<input size= '150' type='text' name="Protocols_information[Library_strategy]" id="Library_strategy" value="" ><br>
				</fieldset>

                <fieldset id="hidden_info">
                    <legend>Data processing pipeline</legend>

                    <label for= "Genome_build"><a href="#" class="info">Genome_build<span>.</span></a></label>
                    <input size= '150' type='text' name="Pipeline_information[Genome_build]" id="Genome_build" value="" ><br>

                    <label for= "Data_files_format_info"><a href="#" class="info">Processed_data_files_format_and_content<span>.</span></a></label>
                    <input size= '150' type='text' name="Pipeline_information[Data_files_format_info][]" id="Data_files_format_info" value="" ><br>

                    <label for= "Data_processing_step"><a href="#" class="info">Data_processing_step<span>.</span></a></label>
                    <input size= '150' type='text' name="Pipeline_information[Data_processing_step][]" id="Data_processing_step" value="" ><br>



                </fieldset>

			<input type="submit" value="Valider">

			</form>
		</div>


        <script type="text/javascript">

            /* trouve le tag "parentTagName" parent de "element" */
            function getParent(element, parentTagName) {
                if ( ! element )
                    return null;
                else if ( element.nodeType == 1 && element.tagName.toLowerCase() == parentTagName.toLowerCase() )
                    return element;
                else
                    return getParent(element.parentNode, parentTagName);
            }

            /* supprimer une ligne */
            function delLigne(link) {
                // 1. récuperer le node "TABLE" à manipuler
                var td = link.parentNode;
                var table = getParent(td, 'TABLE');

                // 2. récuperer le TBODY
                var tbody = table.tBodies[0];

                // 3. Supprimer le TR
                tbody.removeChild(getParent(td, 'TR'));
            }

            function insertAfter(newElement, afterElement) {
                var parent = afterElement.parentNode;

                if (parent.lastChild === afterElement) { // Si le dernier élément est le même que l'élément après lequel on veut insérer, il suffit de faire appendChild()
                    parent.appendChild(newElement);
                } else { // Dans le cas contraire, on fait un insertBefore() sur l'élément suivant
                    parent.insertBefore(newElement, afterElement.nextSibling);
                }
            }


            function load_yaml(){


                data =  <?php echo json_encode(yaml_parse_file("description.yaml")) ?> ;
                //on arrive a lire le yaml en le convertissant en json
                //alert(data["Series_information"]["Contributor"]);
                for ( var $key1 in data ) {

                    for (var $key2 in data[$key1]) {

                        if (Array.isArray(data[$key1][$key2])) { //si c'est un tableau on descends d'un cran
                            var $numberOfLineToAdd = data[$key1][$key2].length - 2;

                            for (var $key3 in data[$key1][$key2]) {
                                //console.log(key2);

                                console.log($key2 + " size:" + $numberOfLineToAdd + ":" + data[$key1][$key2][$key3]);

                                /*if (document.getElementsByClassName($key2)) {
                                    var $index2 = 0;
                                    if ($index2 == 0) {
                                        document.getElementById($key2).setAttribute("value", data[$key1][$key2][$key3]);
                                        $index2++;
                                    }
                                    else {

                                        document.getElementById(document.getElementById($key2).setAttribute("value", data[$key1][$key2][$key3]);
                                        $index2++;



                                    }*/


                                    //addLigne();
                                    //var table = getParent(document.getElementById(key2), 'TABLE');


                                    // 2. on va manipuler le TBODY
                                    //var tbody = table.tBodies[0];

                                    // 3. on clone la ligne de reference
                                    //var newTr = tbody.rows[0].cloneNode(true);
                                    //tbody.appendChild(newTr);

                                    //if (document.all)  // pour IE
                                    //newTr.style.display = "block";
                                    //else
                                    //newTr.style.display = "table-row";

                                    //document.getElementById(key2).setAttribute('value', data[key1][key2][key3]);

                                }

                            }
                        else
                            {// si tu es pas un tableau on l'injecte dans value des éléments type input

                                document.getElementById($key2).setAttribute('value', data[$key1][$key2]);

                            }

                        }


                    }
                }



        </script>

        <?php if (file_exists("description.yaml"))?>
        <script>load_yaml()</script>





	</body>
</html>