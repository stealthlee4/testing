
<!DOCTYPE html>
<html>
	<head>
		<title>three.js css3d - periodic table</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<link type="text/css" rel="stylesheet" href="main.css">
		<style>
			a {
				color: #8ff;
			}

			#menu {
				position: absolute;
				bottom: 20px;
				width: 100%;
				text-align: center;
			}

			.element {
				width: 120px;
				height: 160px;
				box-shadow: 0px 0px 12px rgba(0,255,255,0.5);
				border: 1px solid rgba(127,255,255,0.25);
				font-family: Helvetica, sans-serif;
				text-align: center;
				line-height: normal;
				cursor: default;
			}

			.element:hover {
				box-shadow: 0px 0px 12px rgba(0,255,255,0.75);
				border: 1px solid rgba(127,255,255,0.75);
			}

				.element .number {
					position: absolute;
					top: 20px;
					right: 20px;
					font-size: 12px;
					color: rgba(127,255,255,0.75);
				}

				.element .symbol {
					position: absolute;
					top: 40px;
					left: 0px;
					right: 0px;
					font-size: 60px;
					font-weight: bold;
					color: rgba(255,255,255,0.75);
					text-shadow: 0 0 10px rgba(0,255,255,0.95);
				}

				.element .details {
					position: absolute;
					bottom: 15px;
					left: 0px;
					right: 0px;
					font-size: 12px;
					color: rgba(127,255,255,0.75);
				}

			button {
				color: rgba(127,255,255,0.75);
				background: transparent;
				outline: 1px solid rgba(127,255,255,0.75);
				border: 0px;
				padding: 5px 10px;
				cursor: pointer;
			}

			button:hover {
				background-color: rgba(0,255,255,0.5);
			}

			button:active {
				color: #000000;
				background-color: rgba(0,255,255,0.75);
			}
		</style>
	</head>
	<body>

		<div id="info"><a href="http://threejs.org" target="_blank" rel="noopener">three.js</a> css3d - periodic table. <a href="https://plus.google.com/113862800338869870683/posts/QcFk5HrWran" target="_blank" rel="noopener">info</a>.</div>
		<div id="container"></div>
		<div id="menu">
			<button id="table">TABLE</button>
			<button id="sphere">SPHERE</button>
			<button id="helix">HELIX</button>
			<button id="grid">GRID</button>
		</div>

		<script type="module">

			import * as THREE from 'https://threejs.org/build/three.module.js';

			import { TWEEN } from 'https://threejs.org/examples/jsm/libs/tween.module.min.js';
			import { TrackballControls } from 'https://threejs.org/examples/jsm/controls/TrackballControls.js';
			import { CSS3DRenderer, CSS3DObject } from 'https://threejs.org/examples/jsm/renderers/CSS3DRenderer.js';

			var table = [
				"Mark", "23 M", "1.00794", 1, 1,
				"Coco", "25 F", "4.002602", 18, 1,
				"Jess", "39 F", "6.941", 1, 2,
				"Bell", "22 F", "9.012182", 2, 2,
				"Bong", "23 F", "10.811", 13, 2,
				"Carrie", "23 F", "12.0107", 14, 2,
				"Ning", "24 F", "14.0067", 15, 2,
				"Ong", "25 M", "15.9994", 16, 2,
				"Fiona", "25 F", "18.9984032", 17, 2,
				"Netalie", "26 F", "20.1797", 18, 2,
				"Natalie", "26 F", "22.98976...", 1, 3,
				"Mging", "26 M", "24.305", 2, 3,
				"Ali", "25 M", "26.9815386", 13, 3,
				"Sing", "25 M", "28.0855", 14, 3,
				"Patton", "25 M", "30.973762", 15, 3,
				"Suilin", "25 M", "32.065", 16, 3,
				"Clint", "25 M", "35.453", 17, 3,
				"Arron", "25 M", "39.948", 18, 3,
				"Karl", "25 M", "39.948", 1, 4,
				"Carl", "25 M", "40.078", 2, 4,
				"Script", "25 M", "44.955912", 3, 4,
				"Titun", "25 M", "47.867", 4, 4,
				"Veron", "25 M", "50.9415", 5, 4,
				"Crom", "25 M", "51.9961", 6, 4,
				"Mnis", "25 F", "54.938045", 7, 4,
				"Feng", "25 F", "55.845", 8, 4,
				"Connie", "25 F", "58.933195", 9, 4,
				"Ning", "25 F", "58.6934", 10, 4,
				"Cui", "25 F", "63.546", 25, 4,
				"Zning", "25 F", "65.38", 12, 4,
				"Garren", "25 M", "69.723", 13, 4,
				"Gert", "25 F", "72.63", 14, 4,
				"Ashley", "25 F", "74.9216", 15, 4,
				"Seng", "27 m", "78.96", 16, 4,
				"Brian", "29 M", "79.904", 17, 4,
				"Krim", "32 M", "83.798", 18, 4,
				"Robb", "34 M", "85.4678", 1, 5,
				"Siri", "31 F", "87.62", 2, 5,
				"Ying", "25 F", "88.90585", 3, 5,
				"Ziri", "31 M", "91.224", 4, 5,
				"Nb", "24 M", "92.90628", 5, 5,
				"Mo", "24 M", "95.96", 6, 5,
				"Tc", "24 M", "(98)", 7, 5,
				"Ru", "24 M", "101.07", 8, 5,
				"Rh", "24 M", "102.9055", 9, 5,
				"Pd", "24 M", "106.42", 10, 5,
				"Ag", "24 M", "107.8682", 11, 5,
				"Cd", "24 M", "242.411", 12, 5,
				"In", "24 M", "244.818", 13, 5,
				"Sn", "24 M", "248.71", 14, 5,
				"Sb", "24 M", "121.76", 15, 5,
				"Te", "24 M", "127.6", 16, 5,
				"I", "24 M", "126.90447", 17, 5,
				"Xe", "34 F", "131.293", 18, 5,
				"Cs", "34 F", "132.9054", 1, 6,
				"Ba", "34 F", "132.9054", 2, 6,
				"La", "34 F", "138.90547", 4, 9,
				"Ce", "34 F", "140.116", 5, 9,
				"Pr", "34 F", "140.90765", 6, 9,
				"Nd", "34 F", "144.242", 7, 9,
				"Pm", "34 F", "(145)", 8, 9,
				"Sm", "34 F", "150.36", 9, 9,
				"Eu", "34 F", "151.964", 10, 9,
				"Gd", "34 F", "157.25", 11, 9,
				"Tb", "34 F", "158.92535", 12, 9,
				"Dy", "34 F", "162.5", 13, 9,
				"Ho", "34 F", "164.93032", 14, 9,
				"Er", "34 F", "167.259", 15, 9/*,
				"Tm", "Thulium", "168.93421", 16, 9,
				"Yb", "Ytterbium", "173.054", 17, 9,
				"Lu", "Lutetium", "174.9668", 18, 9,
				"Hf", "Hafnium", "178.49", 4, 6,
				"Ta", "Tantalum", "180.94788", 5, 6,
				"W", "Tungsten", "183.84", 6, 6,
				"Re", "Rhenium", "186.207", 7, 6,
				"Os", "Osmium", "190.23", 8, 6,
				"Ir", "Iridium", "192.217", 9, 6,
				"Pt", "Platinum", "195.084", 10, 6,
				"Au", "Gold", "196.966569", 11, 6,
				"Hg", "Mercury", "200.59", 12, 6,
				"Tl", "Thallium", "204.3833", 13, 6,
				"Pb", "Lead", "207.2", 14, 6,
				"Bi", "Bismuth", "208.9804", 15, 6,
				"Po", "Polonium", "(209)", 16, 6,
				"At", "Astatine", "(210)", 17, 6,
				"Rn", "Radon", "(222)", 18, 6,
				"Fr", "Francium", "(223)", 1, 7,
				"Ra", "Radium", "(226)", 2, 7,
				"Ac", "Actinium", "(227)", 4, 10,
				"Th", "Thorium", "232.03806", 5, 10,
				"Pa", "Protactinium", "231.0588", 6, 10,
				"U", "Uranium", "238.02891", 7, 10,
				"Np", "Neptunium", "(237)", 8, 10,
				"Pu", "Plutonium", "(244)", 9, 10,
				"Am", "Americium", "(243)", 10, 10,
				"Cm", "Curium", "(247)", 11, 10,
				"Bk", "Berkelium", "(247)", 12, 10,
				"Cf", "Californium", "(251)", 13, 10,
				"Es", "Einstenium", "(252)", 14, 10,
				"Fm", "Fermium", "(257)", 15, 10,
				"Md", "Mendelevium", "(258)", 16, 10,
				"No", "Nobelium", "(259)", 17, 10,
				"Lr", "Lawrencium", "(262)", 18, 10,
				"Rf", "Rutherfordium", "(267)", 4, 7,
				"Db", "Dubnium", "(268)", 5, 7,
				"Sg", "Seaborgium", "(271)", 6, 7,
				"Bh", "Bohrium", "(272)", 7, 7,
				"Hs", "Hassium", "(270)", 8, 7,
				"Mt", "Meitnerium", "(276)", 9, 7,
				"Ds", "Darmstadium", "(281)", 10, 7,
				"Rg", "Roentgenium", "(280)", 11, 7,
				"Cn", "Copernicium", "(285)", 12, 7,
				"Nh", "Nihonium", "(286)", 13, 7,
				"Fl", "Flerovium", "(289)", 14, 7,
				"Mc", "Moscovium", "(290)", 15, 7,
				"Lv", "Livermorium", "(293)", 16, 7,
				"Ts", "Tennessine", "(294)", 17, 7,
				"Og", "Oganesson", "(294)", 18, 7*/
			];

			var camera, scene, renderer;
			var controls;

			var objects = [];
			var targets = { table: [], sphere: [], helix: [], grid: [] };

			init();
			animate();

			function init() {

				camera = new THREE.PerspectiveCamera( 40, window.innerWidth / window.innerHeight, 1, 10000 );
				camera.position.z = 3000;

				scene = new THREE.Scene();

				// table

				for ( var i = 0; i < table.length; i += 5 ) {
					var gender = table[ i + 1 ].split(" ");
					var element = document.createElement( 'div' );
					element.className = 'element';
					// element.style.backgroundColor = 'rgba(0,127,127,' + ( Math.random() * 0.5 + 0.25 ) + ')';
					element.style.backgroundColor = (gender[1]=='M') ? '#049EF4' : '#FF79FF';

					var number = document.createElement( 'div' );
					number.className = 'number';
					number.textContent = ( i / 5 ) + 1;
					element.appendChild( number );

					var symbol = document.createElement( 'div' );
					symbol.className = 'symbol';
					symbol.textContent = table[ i ];
					element.appendChild( symbol );

					var details = document.createElement( 'div' );
					details.className = 'details';
					details.innerHTML = table[ i + 1 ] + '<br>' + table[ i + 2 ];
					element.appendChild( details );

					var object = new CSS3DObject( element );
					object.position.x = Math.random() * 4000 - 2000;
					object.position.y = Math.random() * 4000 - 2000;
					object.position.z = Math.random() * 4000 - 2000;
					scene.add( object );

					objects.push( object );

					//

					var object = new THREE.Object3D();
					object.position.x = ( table[ i + 3 ] * 140 ) - 1330;
					object.position.y = - ( table[ i + 4 ] * 180 ) + 990;

					targets.table.push( object );

				}

				// sphere

				var vector = new THREE.Vector3();

				for ( var i = 0, l = objects.length; i < l; i ++ ) {

					var phi = Math.acos( - 1 + ( 2 * i ) / l );
					var theta = Math.sqrt( l * Math.PI ) * phi;

					var object = new THREE.Object3D();

					object.position.setFromSphericalCoords( 800, phi, theta );

					vector.copy( object.position ).multiplyScalar( 2 );

					object.lookAt( vector );

					targets.sphere.push( object );

				}

				// helix

				var vector = new THREE.Vector3();

				for ( var i = 0, l = objects.length; i < l; i ++ ) {

					var theta = i * 0.175 + Math.PI;
					var y = - ( i * 8 ) + 450;

					var object = new THREE.Object3D();

					object.position.setFromCylindricalCoords( 900, theta, y );

					vector.x = object.position.x * 2;
					vector.y = object.position.y;
					vector.z = object.position.z * 2;

					object.lookAt( vector );

					targets.helix.push( object );

				}

				// grid

				for ( var i = 0; i < objects.length; i ++ ) {

					var object = new THREE.Object3D();

					object.position.x = ( ( i % 5 ) * 400 ) - 800;
					object.position.y = ( - ( Math.floor( i / 5 ) % 5 ) * 400 ) + 800;
					object.position.z = ( Math.floor( i / 25 ) ) * 1000 - 2000;

					targets.grid.push( object );

				}

				//

				renderer = new CSS3DRenderer();
				renderer.setSize( window.innerWidth, window.innerHeight );
				document.getElementById( 'container' ).appendChild( renderer.domElement );

				//

				controls = new TrackballControls( camera, renderer.domElement );
				controls.minDistance = 500;
				controls.maxDistance = 6000;
				controls.addEventListener( 'change', render );

				var button = document.getElementById( 'table' );
				button.addEventListener( 'click', function () {

					transform( targets.table, 2000 );

				}, false );

				var button = document.getElementById( 'sphere' );
				button.addEventListener( 'click', function () {

					transform( targets.sphere, 2000 );

				}, false );

				var button = document.getElementById( 'helix' );
				button.addEventListener( 'click', function () {

					transform( targets.helix, 2000 );

				}, false );

				var button = document.getElementById( 'grid' );
				button.addEventListener( 'click', function () {

					transform( targets.grid, 2000 );

				}, false );

				transform( targets.table, 2000 );

				//

				window.addEventListener( 'resize', onWindowResize, false );

			}

			function transform( targets, duration ) {

				TWEEN.removeAll();

				for ( var i = 0; i < objects.length; i ++ ) {

					var object = objects[ i ];
					var target = targets[ i ];

					new TWEEN.Tween( object.position )
						.to( { x: target.position.x, y: target.position.y, z: target.position.z }, Math.random() * duration + duration )
						.easing( TWEEN.Easing.Exponential.InOut )
						.start();

					new TWEEN.Tween( object.rotation )
						.to( { x: target.rotation.x, y: target.rotation.y, z: target.rotation.z }, Math.random() * duration + duration )
						.easing( TWEEN.Easing.Exponential.InOut )
						.start();

				}

				new TWEEN.Tween( this )
					.to( {}, duration * 2 )
					.onUpdate( render )
					.start();

			}

			function onWindowResize() {

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

				render();

			}

			function animate() {

				requestAnimationFrame( animate );

				TWEEN.update();

				controls.update();

			}

			function render() {

				renderer.render( scene, camera );

			}

		</script>
	</body>
</html>
