<div id="write" class="container">
<h2>Hello <?php echo $_SESSION['forname'] ?>!</h2>

<p>
	Welcome to Complib database!  &#128522; 
	<br>
	Below is a brief introduction of this database. For more details please see<a class="contentInd" href="help.php">Tutorial page!</a><img src="https://media.giphy.com/media/U6N5RWERu2XTJeRPrq/giphy.gif" height="50px" width="40px"> 
	<br>
</p>

<h2>Introduction</h2>

<p>
	This is an in course project of <u>Introduction to web site and database design for drug discovery</u>
	<br>
	Student Exam Number: B163919
	<br>
	<br>
	<b>1. Content of this database:</b>
	<br>
	The database contains the compounds information produced from five different manufacturers <b>(Asinex, KeyOrganics, MayBridge, Nanosyn, and Oai40000).</b> 
	<br>
	For each compound and its abbreviation we have the following informations:
	<br>
	<ul class="b">
		<li>nAtm: Number of Atoms</li>
		<li>nCar: Number of Carbons</li>
		<li>nNit: Number of Nitrogens</li>
		<li>nOxy: Number of Oxygens</li>
		<li>nSul: Number of Sulphurs</li>
		<li>nCycl: Number of Cycles</li>
		<li>nHDon: Number of Hydrogen Donors</li>
		<li>nHAcc: Number of Hydrogen Acceptors</li>
		<li>nRotBon: Number of Rotatable Bonds</li>
		<li>MW: Molecular Weight</li>
		<li>TPSA: The Polar Surface Area</li>
		<li>XLogP: Estimated LogP</li>
	</ul>
<br>
</p>

<p>
<b>2. About Stats page</b>
<br>
	For this part, it provides three ways (by <a href="Manufacture.php" class="contentInd">Manufactures</a>, <a href="feature_selection.php" class="contentInd">Features</a>, and<a href="correlation.php" class="contentInd">Correlations</a> ) to view the statistics of compounds in the whole database. 
	<br>
	<br>
	<b>3. About Search tool</b>
	<br>
	Here we provide three search methods (by searching<a href="Compound_select.php" class="contentInd">compound range</a>, <a href="Property_select.php" class="contentInd">property value</a> and <a href="catName_search.php" class="contentInd">catalogue name</a>). For the three search methods, 2D/3D model diagrams and the SDF format file for each compound in the search result are provided.
	<br>
	<br>
	<br>
	<br>
</p>
</div>


