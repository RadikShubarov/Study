create
    or replace function lab1(column_name text) returns void
as
$$
declare
    info_record record;

begin
    raise
        info 'No    Имя Столбца    Имя Таблицы  Атрибуты';
    raise
        info '--    -----------    -----------  --------';
    for info_record in
        SELECT row_number() over (order by attname) as row,
               atr.attname,
               pc.relname,
               tp.typname,
               cs.conname,
               csf.conrelid,
               csf.conname                          as is_fk,
               d.description,
               ix.indexrelid :: regclass            as ind


        from pg_attribute atr

                 JOIN pg_class pc ON pc.oid = atr.attrelid AND relkind = 'r'
                 JOIN pg_type tp ON tp.oid = atr.atttypid
                 LEFT JOIN pg_description d ON d.objoid = pc.oid
                 LEFT JOIN pg_constraint cs ON cs.conrelid = pc.oid AND cs.contype = 'p'
                 LEFT JOIN pg_constraint csf ON csf.conrelid = pc.oid AND csf.contype = 'f'
                 LEFT JOIN pg_index ix ON ix.indrelid = pc.oid

        WHERE attname = column_name
        loop

            raise info '% % % Type: %  ', format('%-5s', info_record.row),
                format('%-14s', info_record.attname),
                format('%-12s', info_record.relname),
                info_record.typname;
            raise
                info '% % % ', '.', format('%39s', 'Constr:'),info_record.conname;
            if
                info_record.is_fk IS NOT NULL then
                raise info '% % % % % % % ', '.',format('%67s', info_record.is_fk),'REFERENCES', info_record.conrelid::regclass,'(',info_record.attname,')';
            end if;
            if
                info_record.description IS NOT NULL then
                raise info '% % %   ','.', format('%39s', 'Commen:'),info_record.description;
            end if;
            if
                info_record.ind IS NOT NULL then
                raise info '% % % ', '.', format('%38s', 'Index:'), info_record.ind;
            end if;


        end loop;

end

$$
    language "plpgsql";
