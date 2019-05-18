CREATE FUNCTION dojo.fnc_schedule_logstash()
    RETURNS trigger
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE NOT LEAKPROOF
AS $BODY$
DECLARE
  _ROW RECORD;
BEGIN

  IF (TG_OP = 'DELETE') THEN
      _ROW = OLD;
  ELSE
    _ROW = NEW;
  END IF;

    -- deve-se manter o cd /tmpdir
    -- e tentar executar o comando diretamente com o caminho
    -- absoluto, faz com que o postgres simplesmente ignore
    -- a execução do script :O
  EXECUTE format('COPY (SELECT 1) TO PROGRAM ''cd /dojo/php-dojo/bin; /usr/bin/php ./redis-enqueue.sh %s:%s:%s'' ', TG_TABLE_NAME, _ROW.id, TG_OP);
  RETURN _ROW;
END;
$BODY$;

CREATE CONSTRAINT TRIGGER trg_schedule_logstash AFTER INSERT OR UPDATE OR DELETE ON dojo.usuario  DEFERRABLE FOR EACH ROW EXECUTE PROCEDURE dojo.fnc_schedule_logstash();
CREATE CONSTRAINT TRIGGER trg_schedule_logstash AFTER INSERT OR UPDATE OR DELETE ON dojo.endereco DEFERRABLE FOR EACH ROW EXECUTE PROCEDURE dojo.fnc_schedule_logstash();
CREATE CONSTRAINT TRIGGER trg_schedule_logstash AFTER INSERT OR UPDATE OR DELETE ON dojo.infracao DEFERRABLE FOR EACH ROW EXECUTE PROCEDURE dojo.fnc_schedule_logstash();
CREATE CONSTRAINT TRIGGER trg_schedule_logstash AFTER INSERT OR UPDATE OR DELETE ON dojo.notificacao DEFERRABLE FOR EACH ROW EXECUTE PROCEDURE dojo.fnc_schedule_logstash();
