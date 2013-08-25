<!-- File: /app/View/Posts/index.ctp -->

<h1>Agenda Entries</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($agendaEntries as $agendaEntry): ?>
    <tr>
        <td><?php echo $agendaEntry['AgendaEntry']['id']; ?></td>
        <td><?php echo $agendaEntry['AgendaEntry']['label']; ?></td>
        <td>
            <?php echo $this->Html->link($agendaEntry['AgendaEntry']['classId'],
array('controller' => 'posts', 'action' => 'view', $agendaEntry['AgendaEntry']['classId'])); ?>
        </td>
        <td><?php echo $agendaEntry['AgendaEntry']['startDateTime']; ?></td>
        <td><?php echo $agendaEntry['AgendaEntry']['endDateTime']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>