<?php
/*
Template Name: EDG Report Template v1-de
Author: Edgar Bollow
Description: Custom template for the MainWP Pro Reports extension.
Version: 1.0.0
*/

if (!defined('ABSPATH')) {
	exit;
}

$isModuleActiveAnalytics = is_plugin_active('mainwp-google-analytics-extension/mainwp-google-analytics-extension.php');
$isModuleActiveLighthouse = is_plugin_active('mainwp-lighthouse-extension/mainwp-lighthouse-extension.php');
$isModuleActiveUptime = is_plugin_active('advanced-uptime-monitor-extension/advanced-uptime-monitor-extension.php');
$isModuleActiveMaintenance = is_plugin_active('mainwp-maintenance-extension/mainwp-maintenance-extension.php');
$isModuleActiveBackups = is_plugin_active('wpvivid-backup-mainwp/wpvivid-backup-mainwp.php');
$isModuleActiveVulnerabilityChecker = is_plugin_active('mainwp-vulnerability-checker-extension/mainwp-vulnerability-checker-extension.php');
$isModuleActiveSslMonitor = is_plugin_active('mainwp-ssl-monitor-extension/mainwp-ssl-monitor-extension.php');

$supportEmail = 'edgar@edgarbollow.com';
$supportMessagingId = 'bollowco';

// MainWP Pro Reports renders the PDF with `dompdf`, which supports only a subset of HTML and CSS. Markup and styles are kept simple on purpose. Properties `dompdf` doesn’t support are ignored there.
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		* {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
			border: 0 solid #e5e7eb;
			font: inherit;
		}

		html {
			color-scheme: light;
			text-size-adjust: none;
			-webkit-text-size-adjust: none;
			-moz-text-size-adjust: none;
			print-color-adjust: exact;
		}

		body {
			padding: 60px;
			color: #212121;
			background-color: #fff;
			font-family: ui-sans-serif, system-ui, sans-serif;
			font-size: 13px;
			font-weight: 400;
			line-height: 1.5;
			overflow-wrap: break-word;
			text-wrap: pretty;
			text-underline-offset: .15em;
			text-rendering: optimizeLegibility;
			font-smooth: always;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			-webkit-tap-highlight-color: transparent;
		}

		img {
			display: block;
			width: 100%;
			max-width: 100%;
			height: auto;
			object-fit: cover;
			user-select: none;
			-webkit-user-select: none;
		}

		a {
			color: #1b4768;
			text-decoration: underline;
			text-decoration-thickness: clamp(1px, .0625em, .0625em);
			touch-action: manipulation;
		}

		table {
			width: 100%;
			max-width: 100%;
			table-layout: fixed;
			border-spacing: 0;
		}

		th {
			text-align: left;
		}

		td {
			font-variant-numeric: tabular-nums;
		}

		:focus-visible {
			outline: none;
		}

		h1,
		h2 {
			color: #000;
			font-weight: 700;
			text-wrap: balance;
		}

		h1 {
			font-size: 36px;
			line-height: 1.2;
			letter-spacing: -.01em;
		}

		h2 {
			font-size: 24px;
			line-height: 1.3;
			letter-spacing: -.00875em;
		}

		strong {
			color: #000;
			font-weight: 700;
		}

		table {
			border-width: 1px;
			border-radius: 8px;
			overflow: clip;
			overflow: hidden;
			background-color: #fff;
			font-size: 11px;
			line-height: 1.3;
		}

		.th {
			color: #717171;
			font-weight: 700;
		}

		.th,
		tr:nth-child(even) {
			background-color: #fafafa;
		}

		th,
		td {
			padding: 8px 12px;
			vertical-align: top;
			border-right-width: 1px;
			border-bottom-width: 1px;
		}

		tr th:last-child,
		tr td:last-child {
			border-right: none;
		}

		tbody tr:last-child th,
		tbody tr:last-child td {
			border-bottom: none;
		}

		header {
			margin-bottom: 80px;
			text-align: right;
			line-height: 0;
		}

		header img {
			display: inline-block;
			width: 120px;
		}

		figure {
			padding: 40px;
			border-width: 1px;
			border-radius: 8px;
		}

		figcaption {
			margin-top: 40px;
			padding-top: 20px;
			border-top-width: 1px;
			color: #717171;
			font-size: 11px;
			line-height: 1.3;
			font-style: italic;
		}

		.flow {
			--_spacer: 20px;
		}

		.flow--wide {
			--_spacer: 54px;
		}

		.flow > * + * {
			margin-top: var(--_spacer);
		}

		main.flow > .page-break + * {
			margin-top: 0;
		}

		.text--narrow {
			max-width: 550px;
		}

		.section-heading-spacer {
			margin-bottom: 36px;
		}

		.page-break {
			break-after: always;
			page-break-after: always;
		}

		.table-column-size--20 {
			width: 20%;
		}

		.table-column-size--25 {
			width: 25%;
		}

		.table-column-size--30 {
			width: 30%;
		}

		.table-column-size--35 {
			width: 35%;
		}

		.table-column-size--40 {
			width: 40%;
		}

		.table-column-size--45 {
			width: 45%;
		}

		.table-column-size--50 {
			width: 50%;
		}
	</style>
</head>
<body>
	<main class="flow flow--wide">

		<header>
			<img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9Ijg4LjM2IDY5IDgyMy43MiAxMTIiPjxsaW5lYXJHcmFkaWVudCBpZD0iQSIgeDE9IjE2Mi42NTIiIHkxPSIxNzAuODI1IiB4Mj0iMTA4LjgyOCIgeTI9Ijc5LjA2NyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiPjxzdG9wIG9mZnNldD0iLjAwNCIgc3RvcC1jb2xvcj0iIzFiNDc2OCIvPjxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iIzVkOWFjOSIvPjxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iIzViOTljOSIvPjwvbGluZWFyR3JhZGllbnQ+PGcgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBmaWxsPSJ1cmwoI0EpIiBkPSJNMTMxLjYgMTgxSDg4LjM2NFY2OWw0My4yMzYuMDU5djE5LjMwOGwtMjAuNzU5LjA4NXYyNC42OTVsMjAuNzU5LjA0NXYxOC4zODlsLTIwLjc1OS4xMDZ2MjkuODYybDIwLjc1OS0uMDg2em00LjA4Ny0xOS41MzhsMy42OS4wODZjNC45NDQgMCA4Ljc5Mi0uNjU5IDExLjU0NC0xLjk3NiA0Ljk5NS0yLjQzMiA3LjQ5Mi03LjA5MiA3LjQ5Mi0xMy45ODEgMC01LjgyNS0yLjQyMS05LjgyNy03LjI2My0xMi4wMDUtMi43MDEtMS4yMTYtNi40OTgtMS44NDktMTEuMzkxLTEuOWwtNC4wNzItLjEwNnYtMTguMzg5bDMuNjktLjA0NWM0Ljk0NCAwIDguOTctLjkzNyAxMi4wNzktMi44MTFoMGMzLjA1OC0xLjgyNCA0LjU4Ny01LjA5MSA0LjU4Ny05LjgwMiAwLTUuMjE4LTIuMDM5LTguNjYyLTYuMTE2LTEwLjMzNC0zLjUxNy0xLjE2NS04LjAwMi0xLjc0OC0xMy40NTYtMS43NDhsLS43ODUtLjA4NVY2OS4wNTlsOC4yNzctLjA1OWMxMy44MTIuMjAzIDIzLjU5OCA0LjE3OSAyOS4zNTggMTEuOTI5IDMuNDY2IDQuNzYyIDUuMTk5IDEwLjQ2IDUuMTk5IDE3LjA5NiAwIDYuODM5LTEuNzMzIDEyLjMzNS01LjE5OSAxNi40ODgtMS45MzcgMi4zMy00Ljc5MSA0LjQ1OC04LjU2MyA2LjM4MyA1Ljc1OSAyLjA3NyAxMC4xMDQgNS4zNjkgMTMuMDM1IDkuODc4czQuMzk2IDkuOTc5IDQuMzk2IDE2LjQxMmMwIDYuNjM2LTEuNjgyIDEyLjU4OC01LjA0NiAxNy44NTYtMi4xNDEgMy40OTUtNC44MTYgNi40MzMtOC4wMjcgOC44MTQtMy42MTkgMi43MzUtNy44ODcgNC42MS0xMi44MDYgNS42MjNTMTQ2LjA1NCAxODEgMTQwLjI5NCAxODFoLTQuNjA4eiIvPjxwYXRoIGQ9Ik04ODQuOCAxNTJoMTIuMDhsMTUuMi01My4zNmgtMTIuOEw4OTAgMTM3LjJsLTEwLjA4LTM4LjU2aC04Ljg4bC0xMC4xNiAzOC41Ni05LjM2LTM4LjU2SDgzOC44TDg1NC4wOCAxNTJoMTIuMDhsOS4yOC0zNi42NHptLTEwOC41Ni0yNi42NGMwIDE2LjA4IDExLjc2IDI3LjYgMjcuODQgMjcuNiAxNi4xNiAwIDI3LjkyLTExLjUyIDI3LjkyLTI3LjZzLTExLjc2LTI3LjYtMjcuOTItMjcuNmMtMTYuMDggMC0yNy44NCAxMS41Mi0yNy44NCAyNy42em00NC4wOCAwYzAgOS45Mi02LjQgMTcuNTItMTYuMjQgMTcuNTJzLTE2LjE2LTcuNi0xNi4xNi0xNy41MmMwLTEwIDYuMzItMTcuNTIgMTYuMTYtMTcuNTJzMTYuMjQgNy41MiAxNi4yNCAxNy41MnpNNzMzLjUyIDE1MmgzMy45MnYtMTBoLTIyLjU2Vjk4LjY0aC0xMS4zNnptLTQ3LjQ0IDBINzIwdi0xMGgtMjIuNTZWOTguNjRoLTExLjM2em0tNjkuMzYtMjYuNjRjMCAxNi4wOCAxMS43NiAyNy42IDI3Ljg0IDI3LjYgMTYuMTYgMCAyNy45Mi0xMS41MiAyNy45Mi0yNy42cy0xMS43Ni0yNy42LTI3LjkyLTI3LjZjLTE2LjA4IDAtMjcuODQgMTEuNTItMjcuODQgMjcuNnptNDQuMDggMGMwIDkuOTItNi40IDE3LjUyLTE2LjI0IDE3LjUycy0xNi4xNi03LjYtMTYuMTYtMTcuNTJjMC0xMCA2LjMyLTE3LjUyIDE2LjE2LTE3LjUyczE2LjI0IDcuNTIgMTYuMjQgMTcuNTJ6TTU2MC42NCAxNTJoMjguOTZjMTAuMTYgMCAxNS41Mi02LjQgMTUuNTItMTQuNCAwLTYuNzItNC41Ni0xMi4yNC0xMC4yNC0xMy4xMiA1LjA0LTEuMDQgOS4yLTUuNTIgOS4yLTEyLjI0IDAtNy4xMi01LjItMTMuNi0xNS4zNi0xMy42aC0yOC4wOHpNNTcyIDEyMC4wOHYtMTEuNzZoMTQuMjRjMy44NCAwIDYuMjQgMi41NiA2LjI0IDUuODQgMCAzLjQ0LTIuNCA1LjkyLTYuMjQgNS45MnptMCAyMi4yNHYtMTIuNTZoMTQuNjRjNC40OCAwIDYuODggMi44OCA2Ljg4IDYuMjQgMCAzLjg0LTIuNTYgNi4zMi02Ljg4IDYuMzJ6TTUwNy42OCAxNTJoMTMuMDRsLTEyLTIwLjMyYzUuNzYtMS4zNiAxMS42OC02LjQgMTEuNjgtMTUuODQgMC05LjkyLTYuOC0xNy4yLTE3LjkyLTE3LjJoLTI0Ljk2VjE1MmgxMS4zNnYtMTkuMTJoOC4zMnptMS4xMi0zNi4yNGMwIDQuNDgtMy40NCA3LjM2LTggNy4zNmgtMTEuOTJWMTA4LjRoMTEuOTJjNC41NiAwIDggMi44OCA4IDcuMzZ6TTQ1NC41NiAxNTJoMTIuNEw0NDYuNCA5OC42NGgtMTQuMjRMNDExLjUyIDE1Mkg0MjRsMy4zNi05LjJoMjMuODR6bS0xNS4yOC00My41Mmw4LjggMjQuNDhINDMwLjR6TTM1MiAxMjUuMzZjMCAxNi44IDEyLjggMjcuNjggMjguNCAyNy42OCA5LjY4IDAgMTcuMjgtNCAyMi43Mi0xMC4wOHYtMjAuNGgtMjUuNDR2OS43NmgxNC4yNHY2LjQ4Yy0yLjMyIDIuMDgtNi42NCA0LjA4LTExLjUyIDQuMDgtOS42OCAwLTE2LjcyLTcuNDQtMTYuNzItMTcuNTJzNy4wNC0xNy41MiAxNi43Mi0xNy41MmM1LjYgMCAxMC4xNiAyLjk2IDEyLjY0IDYuNzJsOS40NC01LjEyYy00LjA4LTYuMzItMTEuMDQtMTEuNjgtMjIuMDgtMTEuNjgtMTUuNiAwLTI4LjQgMTAuNzItMjguNCAyNy42ek0yOTEuNTIgMTUyaDIxLjA0YzE2LjcyIDAgMjguMzItMTAuNTYgMjguMzItMjYuNjRzLTExLjYtMjYuNzItMjguMzItMjYuNzJoLTIxLjA0em0xMS4zNi0xMHYtMzMuMzZoOS42OGMxMC45NiAwIDE2LjcyIDcuMjggMTYuNzIgMTYuNzIgMCA5LjA0LTYuMTYgMTYuNjQtMTYuNzIgMTYuNjR6bS02My42IDEwaDM3Ljc2di05Ljg0aC0yNi40di0xMi40aDI1Ljg0VjEyMGgtMjUuODR2LTExLjZoMjYuNHYtOS43NmgtMzcuNzZ6Ii8+PC9nPjwvc3ZnPg==" alt="Logo von Edgar Bollow">
		</header>

		<section aria-labelledby="report-title" class="flow">
			<h1 id="report-title">Website-Statusbericht</h1>
			<div class="flow">
				<p class="text--narrow">Hier ist dein Überblick: wie es deiner Website geht und was ich in diesem Zeitraum für sie erledigt habe. Danke, dass du sie mir anvertraust.</p>
				<p class="text--narrow">Jeder Abschnitt ist kurz erklärt, du brauchst also kein Technikwissen. Abschnitte, in denen sich nichts getan hat, werden ausgeblendet.</p>
				<p class="text--narrow">Fragen oder Wünsche? Schreib mir einfach eine <a href="<?= "mailto:{$supportEmail}" ?>">E-Mail</a> oder per <a href="<?= "https://wa.me/{$supportMessagingId}" ?>" rel="external">WhatsApp</a>.</p>
			</div>
		</section>

		<section aria-label="Übersicht" class="page-break">
			<table>
				<tbody>

					<tr>
						<th scope="row">Website</th>
						<td><a href="[client.site.url]" rel="external">[client.site.name]</a></td>
					</tr>

					<tr>
						<th scope="row">Zeitraum</th>
						<td>[report.daterange]</td>
					</tr>

					<?php if ($isModuleActiveAnalytics): ?>

					<tr>
						<th scope="row">Besuche</th>
						<td>[ga.visits]</td>
					</tr>

					<?php endif; ?>

					<?php if ($isModuleActiveLighthouse): ?>

					<tr>
						<th scope="row">Geschwindigkeit: Computer</th>
						<td>[lighthouse.performance.desktop]/100</td>
					</tr>
					<tr>
						<th scope="row">Geschwindigkeit: Handy</th>
						<td>[lighthouse.performance.mobile]/100</td>
					</tr>

					<?php endif; ?>

					<?php if ($isModuleActiveUptime): ?>

					<tr>
						<th scope="row">Erreichbarkeit (letzte 30 Tage)</th>
						<td>[aum.uptime30]</td>
					</tr>

					<?php endif; ?>

					<tr>
						<th scope="row">Installierte WordPress-Version</th>
						<td>[client.site.version]</td>
					</tr>

					<tr>
						<th scope="row">Updates: WordPress</th>
						<td>[wordpress.updated.count]</td>
					</tr>

					<tr>
						<th scope="row">Updates: Themes</th>
						<td>[theme.updated.count]</td>
					</tr>

					<tr>
						<th scope="row">Updates: Plugins</th>
						<td>[plugin.updated.count]</td>
					</tr>

					<?php if ($isModuleActiveBackups): ?>

					<tr>
						<th scope="row">Erstellte Backups</th>
						<td>[backup.created.count]</td>
					</tr>

					<?php endif; ?>

					<?php if ($isModuleActiveMaintenance): ?>

					<tr>
						<th scope="row">Datenbankbereinigungen</th>
						<td>[maintenance.process.count]</td>
					</tr>

					<?php endif; ?>

					<?php if ($isModuleActiveVulnerabilityChecker): ?>

					<tr>
						<th scope="row">Bekannte Sicherheitslücken</th>
						<td>[vulnerabilities.count]</td>
					</tr>

					<?php endif; ?>

					<tr>
						<th scope="row">Neue Benutzerkonten</th>
						<td>[user.created.count]</td>
					</tr>

					<tr>
						<th scope="row">Gelöschte Benutzerkonten</th>
						<td>[user.deleted.count]</td>
					</tr>

				</tbody>
			</table>
		</section>

		<?php if ($isModuleActiveAnalytics): ?>

		<section aria-labelledby="analytics">
			<div class="flow section-heading-spacer">
				<h2 id="analytics">Besucher deiner Website</h2>
				<p class="text--narrow">Hier siehst du, wie oft deine Website besucht wurde, gemessen mit Google Analytics. Gezählt werden nur Besucher, die im Cookie-Hinweis zustimmen, die tatsächlichen Zahlen liegen also höher. Für den Vergleich von Monat zu Monat sind sie dennoch verlässlich.</p>
			</div>
			<table class="section-heading-spacer">
				<tbody>

					<tr>
						<th scope="row" class="table-column-size--30">Besuche</th>
						<td>[ga.visits]</td>
						<td class="table-column-size--50">Wie oft deine Website in diesem Zeitraum aufgerufen wurde. Ein Besuch endet nach 30 Minuten ohne Aktivität. Kommt dieselbe Person an zwei Tagen vorbei, sind das zwei Besuche – die Zahl entspricht also nicht der Anzahl der Personen.</td>
					</tr>

					<tr>
						<th scope="row">Besucherstärkster Tag</th>
						<td>[ga.visits.maximum]</td>
						<td>Der Tag mit den meisten Besuchen im zurückliegenden Monat, samt Anzahl. Auffällige Spitzen haben meist einen Anlass, zum Beispiel einen Newsletter, einen Social-Media-Beitrag oder eine Pressemeldung.</td>
					</tr>

					<tr>
						<th scope="row">Neue Besuche</th>
						<td>[ga.new.visits]</td>
						<td>Der Anteil der Besuche von Personen, die zum ersten Mal auf deiner Website waren. Der Rest sind Besucher, die zurückkehren. Beides ist wichtig: Neue Besuche zeigen, dass du gefunden wirst, wiederkehrende, dass deine Seite überzeugt. Wer ein anderes Gerät nutzt oder seine Cookies gelöscht hat, zählt erneut als neu.</td>
					</tr>

					<tr>
						<th scope="row">Seitenaufrufe</th>
						<td>[ga.pageviews]</td>
						<td>Wie oft insgesamt eine Seite angezeigt wurde. Sieht sich jemand Startseite, Leistungen und Kontaktseite an, sind das 3 Seitenaufrufe, aber nur 1 Besuch. Auch das erneute Laden einer Seite zählt mit.</td>
					</tr>

					<tr>
						<th scope="row">Seiten pro Besuch</th>
						<td>[ga.pages.visit]</td>
						<td>Wie viele Seiten sich Besucher pro Besuch im Durchschnitt ansehen (Seitenaufrufe geteilt durch Besuche). Ein Wert von 1,0 bedeutet: Es wurde meist nur eine Seite angesehen. Bei 3,0 stöbern Besucher auf mehreren Seiten. Bei kleinen Websites sind niedrige Werte normal, wenn jemand nur eine bestimmte Information sucht, zum Beispiel die Öffnungszeiten.</td>
					</tr>

					<tr>
						<th scope="row">Besuchszeit</th>
						<td>[ga.avg.time]</td>
						<td>Wie lange sich Besucher pro Besuch im Durchschnitt aktiv auf deiner Website aufhalten, angegeben als Stunden:Minuten:Sekunden. Ein Wert von 0:02:05 bedeutet 2 Minuten und 5 Sekunden. Kurze Zeiten sind nicht automatisch schlecht: Wer nur die Telefonnummer sucht, hat sie nach 20 Sekunden gefunden und ist zufrieden.</td>
					</tr>

					<tr>
						<th scope="row">Absprungrate</th>
						<td>[ga.bounce.rate]</td>
						<td>Der Anteil der Besuche, bei denen sich jemand nur ganz kurz umgesehen hat: weniger als 10 Sekunden, keine zweite Seite aufgerufen und nichts ausgelöst (zum Beispiel keine Anfrage gesendet). Ein niedriger Wert ist besser. Er sagt aber nicht, ob jemand gefunden hat, was er suchte: Wer in wenigen Sekunden eine Telefonnummer abliest und anruft, zählt ebenfalls als Absprung.</td>
					</tr>

				</tbody>
			</table>
			<figure>
				[ga.visits.chart]
				<figcaption>Besuche im Verlauf: [ga.startdate] – [ga.enddate]</figcaption>
			</figure>
		</section>

		<?php endif; ?>

		<?php if ($isModuleActiveLighthouse): ?>

		<section aria-labelledby="performance">
			<div class="flow section-heading-spacer">
				<h2 id="performance">Technischer Check deiner Website</h2>
				<p class="text--narrow">Google prüft automatisch, wie schnell deine Website lädt und wie sauber sie gebaut ist – am Computer und am Handy. Einzelne Messungen können leicht voneinander abweichen, deshalb zählt vor allem der Gesamteindruck. 90 bis 100 Punkte gelten als sehr gut. Gerade bei WordPress-Seiten sind Werte in diesem Bereich eher die Ausnahme.</p>
			</div>
			<table>
				<thead>
					<tr>
						<th scope="col" aria-label="Kategorie" class="th table-column-size--25"></th>
						<th scope="col" class="th">Computer</th>
						<th scope="col" class="th">Handy</th>
						<th scope="col" class="th table-column-size--35">Erklärung</th>
					</tr>
				</thead>
				<tbody>

					<tr>
						<th scope="row">Geschwindigkeit</th>
						<td>[lighthouse.performance.desktop]/100</td>
						<td>[lighthouse.performance.mobile]/100</td>
						<td>Wie schnell deine Seite lädt, wie schnell sie auf Klicks reagiert und ob beim Laden nichts verrutscht. Je höher der Wert, desto weniger müssen Besucher warten.</td>
					</tr>

					<tr>
						<th scope="row">Barrierefreiheit</th>
						<td>[lighthouse.accessibility.desktop]/100</td>
						<td>[lighthouse.accessibility.mobile]/100</td>
						<td>Wie gut deine Seite für alle nutzbar ist, auch für Menschen mit Einschränkungen, etwa beim Sehen. Geprüft werden zum Beispiel Farbkontraste, Bildbeschreibungen und beschriftete Formularfelder. Der Test erkennt nur einen Teil möglicher Hürden, 100 Punkte heißen also nicht, dass alles perfekt ist.</td>
					</tr>

					<tr>
						<th scope="row">Technische Qualität</th>
						<td>[lighthouse.bestpractices.desktop]/100</td>
						<td>[lighthouse.bestpractices.mobile]/100</td>
						<td>Ob deine Seite nach aktuellen technischen Standards gebaut ist, zum Beispiel mit sicherer Verbindung (HTTPS) und ohne versteckte Fehlermeldungen im Hintergrund.</td>
					</tr>

					<tr>
						<th scope="row">Auffindbarkeit (SEO)</th>
						<td>[lighthouse.seo.desktop]/100</td>
						<td>[lighthouse.seo.mobile]/100</td>
						<td>Ob die technischen Grundlagen stimmen, damit Suchmaschinen wie Google deine Seite lesen und anzeigen können, zum Beispiel Seitentitel und Beschreibung. Der Wert sagt nicht, auf welchem Platz du bei Google erscheinst.</td>
					</tr>

					<tr>
						<th scope="row">Letzte Messung</th>
						<td>[lighthouse.lastcheck.desktop]</td>
						<td>[lighthouse.lastcheck.mobile]</td>
						<td>Wann der Test zuletzt gelaufen ist.</td>
					</tr>

				</tbody>
			</table>
		</section>

		<?php endif; ?>

		<?php if ($isModuleActiveUptime): ?>

		<section aria-labelledby="uptime">
			<div class="flow section-heading-spacer">
				<h2 id="uptime">Erreichbarkeit deiner Website</h2>
				<p class="text--narrow">Hier siehst du, wie zuverlässig deine Website online war. Dafür wird regelmäßig von außen geprüft, ob sie antwortet. Zur Einordnung: 99,9&nbsp;% heißt rund 43 Minuten Ausfall im Monat.</p>
			</div>
			<table>
				<tbody>

					<tr>
						<th scope="row">Letzte 30 Tage</th>
						<td>[aum.uptime30]</td>
					</tr>

					<tr>
						<th scope="row">Seit Beginn der Überwachung</th>
						<td>[aum.alltimeuptimeratio]</td>
					</tr>

				</tbody>
			</table>
		</section>

		<?php endif; ?>

		[config-section-data]
		[hide-if-empty]

		<section aria-labelledby="wordpress-updates">
			<div class="flow section-heading-spacer">
				<h2 id="wordpress-updates">WordPress-Updates</h2>
				<p class="text--narrow">WordPress ist die Software, auf der deine Website läuft. Updates schließen Sicherheitslücken und beheben Fehler.</p>
			</div>
			<table>
				<thead>
					<tr>
						<th scope="col" class="th table-column-size--40">Datum</th>
						<th scope="col" class="th">Vorher</th>
						<th scope="col" class="th">Nachher</th>
					</tr>
				</thead>
				<tbody>

					[section.wordpress.updated]

					<tr>
						<td>[wordpress.updated.date]</td>
						<td>[wordpress.old.version]</td>
						<td>[wordpress.current.version]</td>
					</tr>

					[/section.wordpress.updated]

				</tbody>
			</table>
		</section>

		[/config-section-data]

		[config-section-data]
		[hide-if-empty]

		<section aria-labelledby="theme-updates">
			<div class="flow section-heading-spacer">
				<h2 id="theme-updates">Theme-Updates</h2>
				<p class="text--narrow">Das Theme ist das Grundgerüst für Aufbau und Gestaltung deiner Website. Updates halten es sicher und aktuell, am Aussehen ändert sich dabei in der Regel nichts.</p>
			</div>
			<table>
				<thead>
					<tr>
						<th scope="col" class="th table-column-size--25">Datum</th>
						<th scope="col" class="th table-column-size--35">Theme</th>
						<th scope="col" class="th">Vorher</th>
						<th scope="col" class="th">Nachher</th>
					</tr>
				</thead>
				<tbody>

					[section.themes.updated]

					<tr>
						<td>[theme.updated.date]</td>
						<td>[theme.name]</td>
						<td>[theme.old.version]</td>
						<td>[theme.current.version]</td>
					</tr>

					[/section.themes.updated]

				</tbody>
			</table>
		</section>

		[/config-section-data]

		[config-section-data]
		[hide-if-empty]

		<section aria-labelledby="plugin-updates">
			<div class="flow section-heading-spacer">
				<h2 id="plugin-updates">Plugin-Updates</h2>
				<p class="text--narrow">Plugins sind Erweiterungen, zum Beispiel für das Kontaktformular. Hier entstehen die meisten Sicherheitslücken, deshalb sind diese Updates besonders wichtig.</p>
			</div>
			<table>
				<thead>
					<tr>
						<th scope="col" class="th table-column-size--25">Datum</th>
						<th scope="col" class="th table-column-size--35">Plugin</th>
						<th scope="col" class="th">Vorher</th>
						<th scope="col" class="th">Nachher</th>
					</tr>
				</thead>
				<tbody>

					[section.plugins.updated]

					<tr>
						<td>[plugin.updated.date]</td>
						<td>[plugin.name]</td>
						<td>[plugin.old.version]</td>
						<td>[plugin.current.version]</td>
					</tr>

					[/section.plugins.updated]

				</tbody>
			</table>
		</section>

		[/config-section-data]

		<?php if ($isModuleActiveBackups): ?>

		<section aria-labelledby="backups">
			<div class="flow section-heading-spacer">
				<h2 id="backups">Backups</h2>
				<p class="text--narrow">Ein Backup ist eine Sicherheitskopie deiner Website. Geht etwas schief, kann sie auf einen früheren Stand zurückgesetzt werden. Backups werden regelmäßig automatisch angelegt.</p>
			</div>
			<table>
				<tbody>

					<tr>
						<th scope="row">Datenbank (z.&nbsp;B. Texte, Seiten, Einstellungen)</th>
						<td>Alle 2 Stunden</td>
					</tr>

					<tr>
						<th scope="row">Dateien (z.&nbsp;B. Bilder, Theme, Plugins)</th>
						<td>Alle 8 Stunden</td>
					</tr>

					<tr>
						<th scope="row">Wie weit zurück</th>
						<td>3 Monate</td>
					</tr>

					<tr>
						<th scope="row">Wo gespeichert</th>
						<td>Bei Hetzner in Deutschland, getrennt von deiner Website</td>
					</tr>

					<tr>
						<th scope="row">Erstellte Backups in diesem Zeitraum</th>
						<td>[backup.created.count]</td>
					</tr>

				</tbody>
			</table>
		</section>

		<?php endif; ?>

		<?php if ($isModuleActiveMaintenance): ?>

		[config-section-data]
		[hide-if-empty]

		<section aria-labelledby="database-cleanups">
			<div class="flow section-heading-spacer">
				<h2 id="database-cleanups">Datenbankbereinigungen</h2>
				<p class="text--narrow">In der Datenbank deiner Website sammeln sich mit der Zeit Reste an, die keiner mehr braucht. Sie werden regelmäßig automatisch aufgeräumt.</p>
			</div>
			<table>
				<thead>
					<tr>
						<th scope="col" class="th table-column-size--30">Datum</th>
						<th scope="col" class="th">Was passiert ist</th>
					</tr>
				</thead>
				<tbody>

					[section.maintenance.process]

					<tr>
						<td>[maintenance.process.date]</td>
						<td>[maintenance.process.details]</td>
					</tr>

					[/section.maintenance.process]

				</tbody>
			</table>
		</section>

		[/config-section-data]

		<?php endif; ?>

		<?php if ($isModuleActiveVulnerabilityChecker || $isModuleActiveSslMonitor): ?>

		<section aria-labelledby="security">
			<div class="flow section-heading-spacer">
				<h2 id="security">Sicherheit deiner Website</h2>
				<p class="text--narrow">Hier siehst du, ob deine Website gut geschützt ist. Plugins und Themes werden täglich auf bekannte Sicherheitslücken geprüft, die sichere Verbindung wöchentlich.</p>
			</div>
			<table>
				<tbody>

					<?php if ($isModuleActiveVulnerabilityChecker): ?>

					<tr>
						<th scope="row">Bekannte Sicherheitslücken</th>
						<td>[vulnerabilities.count]</td>
						<td class="table-column-size--45">0 heißt: keine bekannte Lücke. Jeder Treffer wird geprüft und schnell behoben, meist per Update.</td>
					</tr>

					<?php endif; ?>

					<?php if ($isModuleActiveSslMonitor): ?>

					<tr>
						<th scope="row">Sichere Verbindung (HTTPS)</th>
						<td>Gültig bis [ssl.monitor.valid.to]</td>
						<td>Sorgt für das Schloss-Symbol im Browser und verlängert sich automatisch.</td>
					</tr>

					<?php endif; ?>

				</tbody>
			</table>
		</section>

		<?php endif; ?>

		[config-section-data]
		[hide-if-empty]

		<section aria-labelledby="new-users">
			<div class="flow section-heading-spacer">
				<h2 id="new-users">Neue Benutzerkonten</h2>
				<p class="text--narrow">Diese Konten wurden neu angelegt. Prüf kurz, ob du alle kennst. Ein fremdes Konto, vor allem mit der Rolle Administrator (darf alles), kann auf einen Einbruch hindeuten. Dann melde dich bitte sofort.</p>
			</div>
			<table>
				<thead>
					<tr>
						<th scope="col" class="th">Datum</th>
						<th scope="col" class="th">Benutzer</th>
						<th scope="col" class="th table-column-size--20">Rolle</th>
						<th scope="col" class="th">Angelegt von</th>
					</tr>
				</thead>
				<tbody>

					[section.users.created]

					<tr>
						<td>[user.created.date]</td>
						<td>[user.name]</td>
						<td>[user.created.role]</td>
						<td>[user.created.author]</td>
					</tr>

					[/section.users.created]

				</tbody>
			</table>
		</section>

		[/config-section-data]

		[config-section-data]
		[hide-if-empty]

		<section aria-labelledby="deleted-users">
			<div class="flow section-heading-spacer">
				<h2 id="deleted-users">Gelöschte Benutzerkonten</h2>
				<p class="text--narrow">Diese Konten wurden gelöscht. Prüf kurz, ob das von dir oder deinem Team kam. Verlässt jemand dein Team, sollte sein Konto immer gelöscht werden.</p>
			</div>
			<table>
				<thead>
					<tr>
						<th scope="col" class="th">Datum</th>
						<th scope="col" class="th">Benutzer</th>
						<th scope="col" class="th table-column-size--20">Rolle</th>
						<th scope="col" class="th">Gelöscht von</th>
					</tr>
				</thead>
				<tbody>

					[section.users.deleted]

					<tr>
						<td>[user.deleted.date]</td>
						<td>[user.name]</td>
						<td>[user.deleted.role]</td>
						<td>[user.deleted.author]</td>
					</tr>

					[/section.users.deleted]

				</tbody>
			</table>
		</section>

		[/config-section-data]

	</main>
</body>
</html>
