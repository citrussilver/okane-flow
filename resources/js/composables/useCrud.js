// resources/js/composables/useCrud.js

import { router } from '@inertiajs/vue3';
import { useModal } from './useModal';
import { useToast } from '@/composables/useToast';

export function useCrud(resourceName, options = {}) {
  const { showModal } = useModal();
  const { handleShowToast } = useToast();

  const enableToast = options.toast === true;
  // Mobile Snackbar support
  const enableSnackbar = options.snackbar === true;

  const notify = (message, type = 'success') => {
    if (enableToast) handleShowToast(message, type);
    if (enableSnackbar) showSnackbar(message, type); // future-proof
  };

  const showSuccessToast = (message) => notify(message, 'success');
  const showErrorToast = (message) => notify(message, 'error');

  const showSnackbar = (message, type = 'success') => {
    if (enableSnackbar) console.log(`🔔 Snackbar: [${type}] ${message}`);
  };

  const deleteRow = (row, opts = {}) => {
    return router.delete(route(`${resourceName}.destroy`, row.id), {
      preserveScroll: true,
      onSuccess: () => {
        showSuccessToast('Delete successful!');
        opts?.onSuccess?.();
      },
      onError: () => {
        showErrorToast('Delete failed!');
        opts?.onError?.();
      },
      ...opts,
    });
  };

  const confirmDelete = async (payload, opts = {}) => {

    console.log('🧩 Received in confirmDelete:', payload);

    const row = payload?.row;
    const details = payload?.details ?? '';

    if (!row) {
      console.warn('⚠️ Missing "row" in confirmDelete payload:', payload);
      return;
    }

    const confirmed = await showModal(
      opts.confirmMessage || `Delete the current row?<br>${details}`
    );

    if (confirmed) {
      console.log('✅ Delete confirmed');
      return deleteRow(row, opts);
    } else {
      console.log('❌ Delete canceled');
    }
  };

  const updateRow = (row, data, opts = {}) => {
    return router.put(route(`${resourceName}.update`, row.id), data, {
      preserveScroll: true,
      onSuccess: () => {
        showSuccessToast('Update successful!');
        opts?.onSuccess?.();
      },
      onError: () => {
        showErrorToast('Update failed!');
        opts?.onError?.();
      },
      ...opts,
    });
  };

  const createRow = (data, opts = {}) => {
    return router.post(route(`${resourceName}.store`), data, {
      preserveScroll: true,
      onSuccess: () => {
        showSuccessToast('Create successful!');
        opts?.onSuccess?.();
      },
      onError: () => {
        showErrorToast('Create failed!');
        opts?.onError?.();
      },
      ...opts,
    });
  };

  return {
    deleteRow,
    confirmDelete,
    updateRow,
    createRow,
  };
}