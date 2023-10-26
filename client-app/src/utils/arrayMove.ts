export const arrayMove = (
  array: any[],
  fromIndex: number,
  toIndex: number,
): any[] => {
  if (toIndex >= array.length) {
    let k = toIndex - array.length + 1;
    while (k--) {
      array.push(undefined);
    }
  }
  array.splice(toIndex, 0, array.splice(fromIndex, 1)[0]);
  return array;
};
