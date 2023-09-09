/**
 * Met à jour la priorité d'une tâche spécifique.
 * 
 * @param {number} taskId - L'ID de la tâche à mettre à jour.
 * @param {string} priority - La nouvelle priorité à attribuer à la tâche.
 */
function updateTaskPriority(taskId, priority) {
    // Envoie une requête POST pour mettre à jour la priorité de la tâche
    fetch('/update-task-priority', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            taskId: taskId,
            priority: priority
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Priorité mise à jour avec succès.');
        } else {
            console.error('Erreur lors de la mise à jour de la priorité.');
        }
    })
    .catch(error => {
        console.error('Erreur lors de la mise à jour de la priorité:', error);
    });
}

/**
 * Met à jour le statut d'une tâche spécifique.
 * 
 * @param {number} taskId - L'ID de la tâche à mettre à jour.
 * @param {string} status - Le nouveau statut à attribuer à la tâche.
 */
function updateTaskStatus(taskId, status) {
    console.log("Mise à jour du statut pour la tâche:", taskId, "avec le statut:", status);
    
    // Envoie une requête POST pour mettre à jour le statut de la tâche
    fetch('/update-task-status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            taskId: taskId,
            status: status
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Statut mis à jour avec succès.');
        } else {
            console.error('Erreur lors de la mise à jour du statut.');
        }
    })
    .catch(error => {
        console.error('Erreur lors de la mise à jour du statut:', error);
    });
}

/**
 * Met à jour un attribut spécifique d'une tâche.
 * 
 * @param {number} taskId - L'ID de la tâche à mettre à jour.
 * @param {string} attribute - L'attribut de la tâche à mettre à jour.
 * @param {string} value - La nouvelle valeur à attribuer à l'attribut.
 */
function updateTaskAttribute(taskId, attribute, value) {
    // Envoie une requête POST pour mettre à jour l'attribut de la tâche
    fetch('/update-task-attribute', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            taskId: taskId,
            attribute: attribute,
            value: value
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log("Mise à jour réussie");
        } else {
            console.error("Erreur lors de la mise à jour");
        }
    });
}
