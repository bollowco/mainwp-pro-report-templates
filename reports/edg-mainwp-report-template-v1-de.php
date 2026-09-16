<?php
/*
Template Name: edg_report_template_v1_de
Description: Custom template for the MainWP Pro Reports extension
Author: Edgar Bollow
Version: 1.0.0
Screenshot URI: ../wp-content/plugins/mainwp-pro-reports-extension/images/template-modern.jpg
*/

$get_config_token = function($option = null) use($report) {
	$showhide_values = json_decode($report->showhide_sections, true) ?? [];
	$config_tokens = [
		0 => '[hide-if-empty]',
		1 => '',
		2 => '[hide-section-data]'
	];

	$option = array_key_exists($option, $showhide_values) ? $showhide_values[$option] : 2;
	return $config_tokens[$option];
};

$is_plugin_active_uptime = is_plugin_active('advanced-uptime-monitor-extension/advanced-uptime-monitor-extension.php');
$is_plugin_active_maintenance = is_plugin_active('mainwp-maintenance-extension/mainwp-maintenance-extension.php');
$is_plugin_active_backups = is_plugin_active('wpvivid-backup-mainwp/wpvivid-backup-mainwp.php');
$is_plugin_active_analytics = is_plugin_active('mainwp-google-analytics-extension/mainwp-google-analytics-extension.php');
$is_plugin_active_lighthouse = is_plugin_active('mainwp-lighthouse-extension/mainwp-lighthouse-extension.php');

$report_heading = $report->heading;
$report_intro = MainWP_Pro_Reports_Utility::esc_content(nl2br($report->intro));
?>
<!DOCTYPE html>
<html lang="de-DE">
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
			-webkit-print-color-adjust: exact;
		}

		body {
			padding: 3.75rem;
			color: #212121;
			background-color: #fff;
			font-family: ui-sans-serif, system-ui, sans-serif;
			font-size: 1rem;
			font-weight: 400;
			line-height: 1.625;
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
			color: inherit;
			text-decoration: none;
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
			font-size: 2.4883rem;
			line-height: 1.2261;
			letter-spacing: -.015em;
		}

		h2 {
			font-size: 1.728rem;
			line-height: 1.3617;
			letter-spacing: -.0075em;
		}

		strong {
			color: #000;
			font-weight: 700;
		}

		a {
			color: #1b4768;
			text-decoration: underline;
			text-decoration-thickness: clamp(1px, .0625em, .0625em);
		}

		table {
			border-width: 1px;
			border-radius: .5rem;
			overflow: clip;
			overflow: hidden;
			background-color: #fff;
			font-size: .875rem;
			line-height: 1.4286;
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
			padding: .5rem .75rem;
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
			margin-bottom: 7.5rem;
			text-align: right;
			line-height: 0;
		}

		header img {
			display: inline-block;
			width: 200px;
			filter: grayscale(1);
		}

		figure {
			padding: 2.5rem;
			border-width: 1px;
			border-radius: .5rem;
		}

		figcaption {
			margin-top: 2.5rem;
			padding-top: 1.25rem;
			border-top-width: 1px;
			color: #717171;
			font-size: .875rem;
			line-height: 1.7143;
			font-style: italic;
		}

		.flow {
			--_spacer: 1.25em;
		}

		.flow > * + * {
			margin-top: var(--_spacer);
		}

		main.flow > .page-break + * {
			margin-top: 0;
		}

		.section-heading-spacer {
			margin-bottom: 2.5rem;
		}

		.page-break {
			break-after: always;
			page-break-after: always;
		}

		.text-size--xl {
			font-size: 1.1875rem;
			line-height: 1.5263;
		}

		.table-column-size--1-4 {
			width: 25%;
		}

		.table-column-size--1-2 {
			width: 50%;
		}
	</style>
</head>
<body>
	<main class="flow" style="--_spacer: 3.75rem;">
		<header>
			<img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9Ijg4LjM2IDY5IDgyMy43MiAxMTIiPjxsaW5lYXJHcmFkaWVudCBpZD0iQSIgeDE9IjE2Mi42NTIiIHkxPSIxNzAuODI1IiB4Mj0iMTA4LjgyOCIgeTI9Ijc5LjA2NyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiPjxzdG9wIG9mZnNldD0iLjAwNCIgc3RvcC1jb2xvcj0iIzFiNDc2OCIvPjxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iIzVkOWFjOSIvPjxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iIzViOTljOSIvPjwvbGluZWFyR3JhZGllbnQ+PGcgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBmaWxsPSJ1cmwoI0EpIiBkPSJNMTMxLjYgMTgxSDg4LjM2NFY2OWw0My4yMzYuMDU5djE5LjMwOGwtMjAuNzU5LjA4NXYyNC42OTVsMjAuNzU5LjA0NXYxOC4zODlsLTIwLjc1OS4xMDZ2MjkuODYybDIwLjc1OS0uMDg2em00LjA4Ny0xOS41MzhsMy42OS4wODZjNC45NDQgMCA4Ljc5Mi0uNjU5IDExLjU0NC0xLjk3NiA0Ljk5NS0yLjQzMiA3LjQ5Mi03LjA5MiA3LjQ5Mi0xMy45ODEgMC01LjgyNS0yLjQyMS05LjgyNy03LjI2My0xMi4wMDUtMi43MDEtMS4yMTYtNi40OTgtMS44NDktMTEuMzkxLTEuOWwtNC4wNzItLjEwNnYtMTguMzg5bDMuNjktLjA0NWM0Ljk0NCAwIDguOTctLjkzNyAxMi4wNzktMi44MTFoMGMzLjA1OC0xLjgyNCA0LjU4Ny01LjA5MSA0LjU4Ny05LjgwMiAwLTUuMjE4LTIuMDM5LTguNjYyLTYuMTE2LTEwLjMzNC0zLjUxNy0xLjE2NS04LjAwMi0xLjc0OC0xMy40NTYtMS43NDhsLS43ODUtLjA4NVY2OS4wNTlsOC4yNzctLjA1OWMxMy44MTIuMjAzIDIzLjU5OCA0LjE3OSAyOS4zNTggMTEuOTI5IDMuNDY2IDQuNzYyIDUuMTk5IDEwLjQ2IDUuMTk5IDE3LjA5NiAwIDYuODM5LTEuNzMzIDEyLjMzNS01LjE5OSAxNi40ODgtMS45MzcgMi4zMy00Ljc5MSA0LjQ1OC04LjU2MyA2LjM4MyA1Ljc1OSAyLjA3NyAxMC4xMDQgNS4zNjkgMTMuMDM1IDkuODc4czQuMzk2IDkuOTc5IDQuMzk2IDE2LjQxMmMwIDYuNjM2LTEuNjgyIDEyLjU4OC01LjA0NiAxNy44NTYtMi4xNDEgMy40OTUtNC44MTYgNi40MzMtOC4wMjcgOC44MTQtMy42MTkgMi43MzUtNy44ODcgNC42MS0xMi44MDYgNS42MjNTMTQ2LjA1NCAxODEgMTQwLjI5NCAxODFoLTQuNjA4eiIvPjxwYXRoIGQ9Ik04ODQuOCAxNTJoMTIuMDhsMTUuMi01My4zNmgtMTIuOEw4OTAgMTM3LjJsLTEwLjA4LTM4LjU2aC04Ljg4bC0xMC4xNiAzOC41Ni05LjM2LTM4LjU2SDgzOC44TDg1NC4wOCAxNTJoMTIuMDhsOS4yOC0zNi42NHptLTEwOC41Ni0yNi42NGMwIDE2LjA4IDExLjc2IDI3LjYgMjcuODQgMjcuNiAxNi4xNiAwIDI3LjkyLTExLjUyIDI3LjkyLTI3LjZzLTExLjc2LTI3LjYtMjcuOTItMjcuNmMtMTYuMDggMC0yNy44NCAxMS41Mi0yNy44NCAyNy42em00NC4wOCAwYzAgOS45Mi02LjQgMTcuNTItMTYuMjQgMTcuNTJzLTE2LjE2LTcuNi0xNi4xNi0xNy41MmMwLTEwIDYuMzItMTcuNTIgMTYuMTYtMTcuNTJzMTYuMjQgNy41MiAxNi4yNCAxNy41MnpNNzMzLjUyIDE1MmgzMy45MnYtMTBoLTIyLjU2Vjk4LjY0aC0xMS4zNnptLTQ3LjQ0IDBINzIwdi0xMGgtMjIuNTZWOTguNjRoLTExLjM2em0tNjkuMzYtMjYuNjRjMCAxNi4wOCAxMS43NiAyNy42IDI3Ljg0IDI3LjYgMTYuMTYgMCAyNy45Mi0xMS41MiAyNy45Mi0yNy42cy0xMS43Ni0yNy42LTI3LjkyLTI3LjZjLTE2LjA4IDAtMjcuODQgMTEuNTItMjcuODQgMjcuNnptNDQuMDggMGMwIDkuOTItNi40IDE3LjUyLTE2LjI0IDE3LjUycy0xNi4xNi03LjYtMTYuMTYtMTcuNTJjMC0xMCA2LjMyLTE3LjUyIDE2LjE2LTE3LjUyczE2LjI0IDcuNTIgMTYuMjQgMTcuNTJ6TTU2MC42NCAxNTJoMjguOTZjMTAuMTYgMCAxNS41Mi02LjQgMTUuNTItMTQuNCAwLTYuNzItNC41Ni0xMi4yNC0xMC4yNC0xMy4xMiA1LjA0LTEuMDQgOS4yLTUuNTIgOS4yLTEyLjI0IDAtNy4xMi01LjItMTMuNi0xNS4zNi0xMy42aC0yOC4wOHpNNTcyIDEyMC4wOHYtMTEuNzZoMTQuMjRjMy44NCAwIDYuMjQgMi41NiA2LjI0IDUuODQgMCAzLjQ0LTIuNCA1LjkyLTYuMjQgNS45MnptMCAyMi4yNHYtMTIuNTZoMTQuNjRjNC40OCAwIDYuODggMi44OCA2Ljg4IDYuMjQgMCAzLjg0LTIuNTYgNi4zMi02Ljg4IDYuMzJ6TTUwNy42OCAxNTJoMTMuMDRsLTEyLTIwLjMyYzUuNzYtMS4zNiAxMS42OC02LjQgMTEuNjgtMTUuODQgMC05LjkyLTYuOC0xNy4yLTE3LjkyLTE3LjJoLTI0Ljk2VjE1MmgxMS4zNnYtMTkuMTJoOC4zMnptMS4xMi0zNi4yNGMwIDQuNDgtMy40NCA3LjM2LTggNy4zNmgtMTEuOTJWMTA4LjRoMTEuOTJjNC41NiAwIDggMi44OCA4IDcuMzZ6TTQ1NC41NiAxNTJoMTIuNEw0NDYuNCA5OC42NGgtMTQuMjRMNDExLjUyIDE1Mkg0MjRsMy4zNi05LjJoMjMuODR6bS0xNS4yOC00My41Mmw4LjggMjQuNDhINDMwLjR6TTM1MiAxMjUuMzZjMCAxNi44IDEyLjggMjcuNjggMjguNCAyNy42OCA5LjY4IDAgMTcuMjgtNCAyMi43Mi0xMC4wOHYtMjAuNGgtMjUuNDR2OS43NmgxNC4yNHY2LjQ4Yy0yLjMyIDIuMDgtNi42NCA0LjA4LTExLjUyIDQuMDgtOS42OCAwLTE2LjcyLTcuNDQtMTYuNzItMTcuNTJzNy4wNC0xNy41MiAxNi43Mi0xNy41MmM1LjYgMCAxMC4xNiAyLjk2IDEyLjY0IDYuNzJsOS40NC01LjEyYy00LjA4LTYuMzItMTEuMDQtMTEuNjgtMjIuMDgtMTEuNjgtMTUuNiAwLTI4LjQgMTAuNzItMjguNCAyNy42ek0yOTEuNTIgMTUyaDIxLjA0YzE2LjcyIDAgMjguMzItMTAuNTYgMjguMzItMjYuNjRzLTExLjYtMjYuNzItMjguMzItMjYuNzJoLTIxLjA0em0xMS4zNi0xMHYtMzMuMzZoOS42OGMxMC45NiAwIDE2LjcyIDcuMjggMTYuNzIgMTYuNzIgMCA5LjA0LTYuMTYgMTYuNjQtMTYuNzIgMTYuNjR6bS02My42IDEwaDM3Ljc2di05Ljg0aC0yNi40di0xMi40aDI1Ljg0VjEyMGgtMjUuODR2LTExLjZoMjYuNHYtOS43NmgtMzcuNzZ6Ii8+PC9nPjwvc3ZnPg==" alt="Logo &ndash; Edgar Bollow">
		</header>
		<section class="flow page-break" aria-labelledby="website-care-report">
			<h1 id="website-care-report"><?= $report_heading ?></h1>
			<div class="flow text-size--xl"><?= $report_intro ?></div>
		</section>
		<section aria-labelledby="overview">
			<h2 id="overview" class="section-heading-spacer">Übersicht</h2>
			<table>
				<tbody>
					<tr>
						<th>Website</th>
						<td><a href="[client.site.url]" rel="external">[client.site.name]</a></td>
					</tr>
					<tr>
						<th>Zeitraum</th>
						<td>[report.daterange]</td>
					</tr>
					<tr>
						<th>PHP-Version</th>
						<td>[client.site.php]</td>
					</tr>
					<tr>
						<th>WordPress-Version</th>
						<td>[client.site.version]</td>
					</tr>
					<?php if ($is_plugin_active_uptime): ?>
					[config-section-data]
					[config-section-extra max-empty="1" /]
					<?= $get_config_token('uptime') ?>
					<tr>
						<th>Erreichbarkeitsquote insgesamt bisher</th>
						<td>[aum.alltimeuptimeratio]</td>
					</tr>
					[/config-section-data]
					<?php endif; ?>
					[config-section-data]
					[config-section-extra max-empty="1" /]
					<?= $get_config_token('wp-update') ?>
					<tr>
						<th>Durchgeführte WordPress Core-Updates</th>
						<td>[wordpress.updated.count]</td>
					</tr>
					[/config-section-data]
					[config-section-data]
					[config-section-extra max-empty="1" /]
					<?= $get_config_token('themes-updates') ?>
					<tr>
						<th>Durchgeführte Theme-Updates</th>
						<td>[theme.updated.count]</td>
					</tr>
					[/config-section-data]
					[config-section-data]
					[config-section-extra max-empty="1" /]
					<?= $get_config_token('plugins-updates') ?>
					<tr>
						<th>Durchgeführte Plugin-Updates</th>
						<td>[plugin.updated.count]</td>
					</tr>
					[/config-section-data]
					<?php if ($is_plugin_active_maintenance): ?>
					[config-section-data]
					[config-section-extra max-empty="1" /]
					<?= $get_config_token('maintenance') ?>
					<tr>
						<th>Durchgeführte Cleanup-Routinen</th>
						<td>[maintenance.process.count]</td>
					</tr>
					[/config-section-data]
					<?php endif; ?>
					<?php if ($is_plugin_active_backups): ?>
					[config-section-data]
					[config-section-extra max-empty="1" /]
					<?= $get_config_token('backups') ?>
					<tr>
						<th>Erstellte Backups</th>
						<td>[backup.created.count]</td>
					</tr>
					[/config-section-data]
					<?php endif; ?>
					<?php if ($is_plugin_active_analytics): ?>
					[config-section-data]
					[config-section-extra max-empty="1" /]
					<?= $get_config_token('ga') ?>
					<tr>
						<th>Besuche</th>
						<td>[ga.visits]</td>
					</tr>
					[/config-section-data]
					<?php endif; ?>
					<?php if ($is_plugin_active_lighthouse): ?>
					[config-section-data]
					[config-section-extra max-empty="2" /]
					<?= $get_config_token('lighthouse') ?>
					<tr>
						<th>Desktop-Geschwindigkeit</th>
						<td>[lighthouse.performance.desktop] / 100</td>
					</tr>
					<tr>
						<th>Mobile-Geschwindigkeit</th>
						<td>[lighthouse.performance.mobile] / 100</td>
					</tr>
					[/config-section-data]
					<?php endif; ?>
				</tbody>
			</table>
		</section>
		<?php if ($is_plugin_active_uptime): ?>
		[config-section-data]
		[config-section-extra max-empty="4" /]
		<?= $get_config_token('uptime') ?>
		<section aria-labelledby="uptime-ratio">
			<div class="flow section-heading-spacer">
				<h2 id="uptime-ratio">Erreichbarkeitsquote</h2>
				<p>Die Erreichbarkeitsquote gibt an, wie oft die Website im Laufe des aktuellen Zeitraums verfügbar war. Eine Erreichbarkeit von z. B. 98 % bedeutet, dass die Website in 98 % der Zeit ohne Probleme online und erreichbar gewesen ist.</p>
			</div>
			<table>
				<tbody>
					<tr>
						<th>Insgesamt bisher</th>
						<td>[aum.alltimeuptimeratio]</td>
					</tr>
					<tr>
						<th>Letzte Woche</th>
						<td>[aum.uptime7]</td>
					</tr>
					<tr>
						<th>Letzten Monat</th>
						<td>[aum.uptime30]</td>
					</tr>
					<tr>
						<th>Letzten 2 Monate</th>
						<td>[aum.uptime60]</td>
					</tr>
				</tbody>
			</table>
		</section>
		[/config-section-data]
		<?php endif; ?>
		[config-section-data]
		<?= $get_config_token('wp-update') ?>
		<section aria-labelledby="wp-updates">
			<div class="flow section-heading-spacer">
				<h2 id="wp-updates">WordPress Core-Updates</h2>
				<p>WordPress ist die Basis-Software, die die Website antreibt. Regelmäßige Updates halten sie sicher und auf dem neuesten Stand.</p>
			</div>
			<table>
				<thead>
					<tr>
						<th class="th">Zeitpunkt</th>
						<th class="th">Alte Version</th>
						<th class="th">Aktuelle Version</th>
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
		<?= $get_config_token('themes-updates') ?>
		<section aria-labelledby="themes-updates">
			<div class="flow section-heading-spacer">
				<h2 id="themes-updates">Theme-Updates</h2>
				<p>Das Theme bestimmt das Design und meist auch die Struktur der Website. Durch Updates bleibt es kompatibel mit neuen Funktionen und Sicherheitsstandards.</p>
			</div>
			<table>
				<thead>
					<tr>
						<th class="th">Zeitpunkt</th>
						<th class="th">Theme</th>
						<th class="th">Alte Version</th>
						<th class="th">Aktuelle Version</th>
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
		<?= $get_config_token('plugins-updates') ?>
		<section aria-labelledby="plugins-updates">
			<div class="flow section-heading-spacer">
				<h2 id="plugins-updates">Plugin-Updates</h2>
				<p>Plugins erweitern die Website um zusätzliche Funktionalität. Ihre Updates verbessern oft Sicherheit und Leistung.</p>
			</div>
			<table>
				<thead>
					<tr>
						<th class="th">Zeitpunkt</th>
						<th class="th">Plugin</th>
						<th class="th">Alte Version</th>
						<th class="th">Aktuelle Version</th>
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
		<?php if ($is_plugin_active_maintenance): ?>
		[config-section-data]
		<?= $get_config_token('maintenance') ?>
		<section aria-labelledby="cleanup-tasks">
			<div class="flow section-heading-spacer">
				<h2 id="cleanup-tasks">Cleanup-Routinen</h2>
				<p>Diese Routinewartungen sorgen dafür, dass die Datenbank der Website aufgeräumt bleibt und reibungslos funktioniert, indem unnötige oder veraltete Daten entfernt werden.</p>
			</div>
			<table>
				<thead>
					<tr>
						<th class="th table-column-size--1-4">Zeitpunkt</th>
						<th class="th">Details</th>
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
		<?php if ($is_plugin_active_backups): ?>
		[config-section-data]
		<?= $get_config_token('backups') ?>
		<section aria-labelledby="backups">
			<div class="flow section-heading-spacer">
				<h2 id="backups">Backups</h2>
				<p>Backups sind Sicherheitskopien der Website, um Datenverlust vorzubeugen. In der Regel wird die Datenbank dreimal täglich gesichert und einmal wöchentlich werden alle Dateien der Website vollständig gespeichert.</p>
			</div>
			<table>
				<thead>
					<tr>
						<th class="th table-column-size--1-4">Zeitpunkt</th>
						<th class="th">Details</th>
					</tr>
				</thead>
				<tbody>
					[section.backups.created]
					<tr>
						<td>[backup.created.date]</td>
						<td>[backup.created.type]</td>
					</tr>
					[/section.backups.created]
				</tbody>
			</table>
		</section>
		[/config-section-data]
		<?php endif; ?>
		[config-section-data]
		<?= $get_config_token('users') ?>
		<section aria-labelledby="added-users">
			<h2 id="added-users" class="section-heading-spacer">Neu hinzugefügte Nutzer</h2>
			<table>
				<thead>
					<tr>
						<th class="th">Zeitpunkt</th>
						<th class="th">Rolle</th>
						<th class="th">Anzeigename</th>
					</tr>
				</thead>
				<tbody>
					[section.users.created]
					<tr>
						<td>[user.created.date]</td>
						<td>[user.created.role]</td>
						<td>[user.name]</td>
					</tr>
					[/section.users.created]
				</tbody>
			</table>
		</section>
		[/config-section-data]
		[config-section-data]
		<?= $get_config_token('users') ?>
		<section aria-labelledby="updated-users">
			<h2 id="updated-users" class="section-heading-spacer">Aktualisierte Nutzer</h2>
			<table>
				<thead>
					<tr>
						<th class="th">Zeitpunkt</th>
						<th class="th">Rolle</th>
						<th class="th">Anzeigename</th>
					</tr>
				</thead>
				<tbody>
					[section.users.updated]
					<tr>
						<td>[user.updated.date]</td>
						<td>[user.updated.role]</td>
						<td>[user.name]</td>
					</tr>
					[/section.users.updated]
				</tbody>
			</table>
		</section>
		[/config-section-data]
		[config-section-data]
		<?= $get_config_token('users') ?>
		<section aria-labelledby="deleted-users">
			<h2 id="deleted-users" class="section-heading-spacer">Gelöschte Nutzer</h2>
			<table>
				<thead>
					<tr>
						<th class="th">Zeitpunkt</th>
						<th class="th">Rolle</th>
						<th class="th">Anzeigename</th>
					</tr>
				</thead>
				<tbody>
					[section.users.deleted]
					<tr>
						<td>[user.deleted.date]</td>
						<td>[user.deleted.role]</td>
						<td>[user.name]</td>
					</tr>
					[/section.users.deleted]
				</tbody>
			</table>
		</section>
		[/config-section-data]
		<?php if ($is_plugin_active_analytics): ?>
		[config-section-data]
		[config-section-extra max-empty="7" /]
		<?= $get_config_token('ga') ?>
		<section aria-labelledby="analytics">
			<div class="flow section-heading-spacer">
				<h2 id="analytics">Analytics</h2>
				<p>Google Analytics ist ein Analysetool, das Daten über die Website-Besucher erfasst. So erhältst du wertvolle Einblicke in das Nutzerverhalten auf der Website.</p>
			</div>
			<table class="section-heading-spacer">
				<tbody>
					<tr>
						<th style="width: 30%;">Besuche</th>
						<td>[ga.visits]</td>
						<td class="table-column-size--1-2">Ein Besuch zählt jedes Mal, wenn ein Nutzer die Website betritt, unabhängig davon, wie viele Seiten er sich anschaut. Ein Besuch beginnt, wenn ein Nutzer auf die Seite kommt, und endet, wenn er sie verlässt oder 30 Minuten lang inaktiv war.</td>
					</tr>
					<tr>
						<th>Neue Besuche</th>
						<td>[ga.new.visits]</td>
						<td>Dieser Prozentsatz spiegelt die Anzahl der Besuche wieder, die von neuen Nutzern stammen. Das sind Besucher, die zum ersten Mal auf der Website sind und nicht von einem vorherigen Besuch stammen.</td>
					</tr>
					<tr>
						<th>Besuchszeit</th>
						<td>[ga.avg.time]</td>
						<td>Die Besuchszeit misst, wie lange ein Nutzer im Durchschnitt auf der Website bleibt, bevor er sie verlässt.</td>
					</tr>
					<tr>
						<th>Seitenaufrufe pro Besuch</th>
						<td>[ga.pages.visit]</td>
						<td>Diese Zahl zeigt, wie viele Seiten ein Nutzer im Durchschnitt während eines einzigen Besuchs auf der Website aufruft.</td>
					</tr>
					<tr>
						<th>Absprungrate</th>
						<td>[ga.bounce.rate]</td>
						<td>Die Absprungrate gibt den Prozentsatz der Besuche an, bei denen ein Nutzer nur eine einzige Seite auf der Website aufgerufen hat und sie dann ohne weitere Interaktionen wieder verlassen hat.</td>
					</tr>
					<tr>
						<th>Seitenaufrufe</th>
						<td>[ga.pageviews]</td>
						<td>Seitenaufrufe zählen jedes Mal, wenn eine Seite der Website angesehen wird, unabhängig davon, ob der Nutzer sie schon zuvor während derselben Sitzung (Besuch) besucht hat. Wenn ein Nutzer während eines Besuchs mehrere Seiten aufruft, zählt jede dieser Seiten als ein eigener Seitenaufruf.</td>
					</tr>
				</tbody>
			</table>
			<figure>
				[ga.visits.chart]
				<figcaption>Website-Besuche des aktuellen Zeitraums grafisch dargestellt</figcaption>
			</figure>
		</section>
		[/config-section-data]
		<?php endif; ?>
		<?php if ($is_plugin_active_lighthouse): ?>
		[config-section-data]
		[config-section-extra max-empty="10" /]
		<?= $get_config_token('lighthouse') ?>
		<section aria-labelledby="performance">
			<div class="flow section-heading-spacer">
				<h2 id="performance">Performance</h2>
				<p>Dies sind die Ergebnisse der regelmäßigen Leistungstests der Website, die mit dem Tool <a href="https://pagespeed.web.dev" rel="external">Google Lighthouse</a> durchgeführt wurden. Die Werte geben Einblicke in verschiedene Aspekte der Website-Performance auf Desktop- und Mobilgeräten.</p>
			</div>
			<table>
				<thead>
					<tr>
						<th class="th" style="width: 30%;"></th>
						<th class="th">Desktop</th>
						<th class="th">Mobile</th>
						<th class="th" style="width: 30%;">Anmerkung</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>Geschwindigkeit</th>
						<td>[lighthouse.performance.desktop] / 100</td>
						<td>[lighthouse.performance.mobile] / 100</td>
						<td>Die Geschwindigkeit bewertet die Ladezeit und Reaktionsfähigkeit der Website.</td>
					</tr>
					<tr>
						<th>Barrierefreiheit</th>
						<td>[lighthouse.accessibility.desktop] / 100</td>
						<td>[lighthouse.accessibility.mobile] / 100</td>
						<td>Barrierefreiheit bedeutet, wie gut die Website für alle Benutzer zugänglich ist, einschließlich Menschen mit Behinderungen.</td>
					</tr>
					<tr>
						<th>Best Practices</th>
						<td>[lighthouse.bestpractices.desktop] / 100</td>
						<td>[lighthouse.bestpractices.mobile] / 100</td>
						<td>Dieser Score misst, ob die Website bewährte Webstandards einhält.</td>
					</tr>
					<tr>
						<th>SEO</th>
						<td>[lighthouse.seo.desktop] / 100</td>
						<td>[lighthouse.seo.mobile] / 100</td>
						<td>SEO (Suchmaschinenoptimierung) zeigt, wie gut die Website auf Suchmaschinen wie Google sichtbar ist.</td>
					</tr>
					<tr>
						<th>Zeitpunkt der Messung</th>
						<td>[lighthouse.lastcheck.desktop]</td>
						<td>[lighthouse.lastcheck.mobile]</td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</section>
		[/config-section-data]
		<?php endif; ?>
	</main>
</body>
</html>
