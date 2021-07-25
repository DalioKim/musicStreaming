<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta charset="utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="description" content="This is a Juicebox Gallery. Get yours at www.juicebox.net" />
<style type="text/css">
@import url(http://fonts.googleapis.com/earlyaccess/hanna.css);
	body {
		margin: 0px;
		}
	a{
		 cursor: hand;
		 color: #F28011;
		 text-decoration: none;
		 font-size: 11pt;
		 text-align: left;
		 font-family: 'Cambria';
	}

	h1{
		 cursor: hand;
		 color: #444444;
		 text-decoration: none;
		 font-family: 'Cambria';
	}



	a:HOVER, a:ACTIVE {
		font-size: 11pt;
		color: #F28011;
		text-decoration: underline;

	}

table
{
  border:solid 0px red;
 }

td
{

  border:solid 0px green;
}
img
{
  display: inline;
  position: relative !important;
  float: left;
}
</style>




<body bgcolor="#FFFFFF">
<link rel="stylesheet" href="default.css"	type = "text/css">
<?php require_once('./class.image.php'); ?>
<?php require_once('./exif.php'); ?>
<?php

$rootpath =	$_REQUEST["currentdirectory"];
$imagepage = $_REQUEST["page"];
if($rootpath == null)
{
	$rootpath = './album';
}

$pos = strrpos($rootpath, '/');
$parentpath =  substr($rootpath , 0, $pos);

if($imagepage == null)
	$imagepage = 0;


function read_all_files($root, $depth)
{
	if($handle = opendir($root))
	{
		while (false !== ($fileeach = readdir($handle)))
		{
			if ($fileeach != "." && $fileeach != "..")
			{

				if(is_dir($root.'/'.$fileeach))
				{
					echo "Directory : $fileeach <br>";
					$depth++;
					read_all_files($root.'/'.$fileeach, $depth);
					$depth--;

				}
				else
				{
					for($i=0; $i< $depth; $i++)
						echo "--";

					list($width, $height, $type, $attr) = getimagesize($root.'/'.$fileeach);
					if($width > $height)
						$factor = 200/$width;
					else
						$factor = 200/$height;
					$width = $width*$factor;
					$height = $height*$factor;
					echo "<img src=\"$root/$fileeach\" width=$width height=$height>";
				}
			}
		}
	}
}



echo "<table border=0 width=1040 align=center><tr height=100><td></td><td align=center><h1 align=center>Junny & Sunny Story</td></tr>
<tr><td width=\"140\" valign=top>";

$depth = 0;

if ($handle = opendir($rootpath))
{
	echo "<table width=140>";
	$foldercount =0;
	while (false != ($entry = readdir($handle)))
	{
        if ($entry != ".")
		{
			if($entry == "..")
			{
				if( $rootpath == './album')
					continue;
			}

			if(is_dir($rootpath.'/'.$entry))
			{
				if($foldercount%1 == 0)
					echo "<tr>";

				if($entry == "..")
				{
					echo "<td width=20><img src=\"folder.png\"></td><td><a href=\"index.php?currentdirectory=".$parentpath."\">".$entry."</a></td>";
				}
				else
					echo "<td width=20><img src=\"folder.png\" valign=middle></td><td><a href=\"index.php?currentdirectory=".$rootpath.'/'.$entry."&parentdirectory=".$rootpath."\">".$entry."</a></td>";

				$foldercount++;
				if($foldercount%1 == 0)
					echo "</tr>";
			}
		}
    }
/*
	if($foldercount%5 != 0)
	{
		for($i=0; $i < 5-($foldercount%5); $i++)
			echo "<td align=center valign=vcenter></td>";
		echo "</tr></table>";
	}
	else
	*/
		echo "</table>";
    closedir($handle);
}

echo "</td><td>";


$fp = fopen("./config.xml",'w');
if($fp)
{
	$strxml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><juiceboxgallery GalleryTitle=\"$rootpath\">";
	fwrite($fp, $strxml);
	////////////////////////////////////////////////////////////
	/// xml ������
	////////////////////////////////////////////////////////////
	$imagecount=0;
	$pageindex = 0;
	if ($handle = opendir($rootpath))
	{
		while (false != ($entry = readdir($handle)))
		{
			if ($entry != "." && $entry != "..")
			{
				if(is_file($rootpath.'/'.$entry))
				{

						if(strpos($entry, "thumb_") !== 0)
						{
							/* ������ �̹��� �ڵ� ���� */
							/*
							$pos = strrpos($entry, '.');
							$filename =  $rootpath."/thumb_".substr($entry , 0, $pos).substr($entry , $pos);
							echo $filename;
							if(!file_exists($filename))
							{
								$image = new Image($rootpath."/".$entry);
								list($width, $height) = getimagesize($rootpath."/".$entry);
								if($width + $height > 4000)
									$image->resize(20);
								else
									$image->resize(10);
								$image->save(false,$filename);
							}
							*/
							/* //Jpeg ���� �б�
							$exif = new exif($rootpath."/".$entry);
							print_r($exif ->getImageInfo());
							*/
							if($imagepage*50 <= $imagecount & ($imagepage*50+50) > $imagecount)
							{
								$strxml = "<image imageURL=\"$rootpath/$entry\" thumbURL=\"$filename\" linkURL=\"$rootpath/$entry\" linkTarget=\"_blank\"><title>$entry</title></image>";
								fwrite($fp, $strxml);
							}

							$imagecount++;




						}
				}
			}
		}
		closedir($handle);
	}

	$pageindex = $imagecount/50;
	for($i=0; $i<$pageindex; $i++)
	{
		echo "<a href=\"index.php?currentdirectory=".$rootpath."&page=".$i."\">".$i."&nbsp&nbsp&nbsp&nbsp</a>";
	}


	////////////////////////////////////////////////////////////
	$strxml = "</juiceboxgallery>";
	fwrite($fp, $strxml);
	fclose($fp);
}
?>

<!--START JUICEBOX EMBED-->
<script src="./jbcore/juicebox.js">
</script>
<script type="text/javascript">
new juicebox({
	containerId : "juicebox-container",
	galleryWidth: "900",
	galleryHeight: '600',
	backgroundColor:'rgba(0,0,0,.9)',
	xbackgroundColor:'fff',
	themeUrl:'./jbcore/classic/theme.css'
	}
);
</script>
<div id="juicebox-container"></div>
</td></tr></table>
<!--END JUICEBOX EMBED-->
</body>
